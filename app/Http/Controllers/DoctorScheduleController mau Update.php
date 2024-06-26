<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\DoctorSchedule;

class DoctorScheduleController extends Controller
{
    //index
    public function index(Request $request)
    {
        //$doctorSchedules = DB::table('doctor-schedules')
        $doctorSchedules = DoctorSchedule::with('doctor')

            ->when($request->input('doctor_id'), function ($query, $doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })
            //sort by id
            //->orderBy('id', 'desc')

            ->orderBy('doctor_id', 'asc')
            //load('doctor') //maksudnya agar semua data table doctor bisa ditampilkan
            //menghasilkan syntax error, unexpected identifier "load"

            ->paginate(10);
        return view('pages.doctor-schedules.index', compact('doctorSchedules'));
    }

    //create
    public function create()
    {
        $doctors = Doctor::all();
        return view('pages.doctor-schedules.create', compact('doctors'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'time' => 'required',
        ]);


        $doctorSchedule = new DoctorSchedule;
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->input('day');
        $doctorSchedule->time = $request->input('time');
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;
        $doctorSchedule->save();

        return redirect()->route('doctor-schedules.index')->with('success', ' Schedule created successfully.');
    }


    public function edit($id)
    {


        $doctorSchedule = DoctorSchedule::find($id);
        $doctors = Doctor::all();
        //echo "ID: $doctorSchedule->id, Doctor ID: $doctorSchedule->doctor_id, Day: $doctorSchedule->day <br>";

        //return view('pages.doctor-schedules.edit',compact('doctorSchedule','doctors'));

        $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('pages.doctor-schedules.edit', compact('doctorSchedule', 'doctors', 'daysOfWeek'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            // Add validation rules for other fields if necessary
        ]);

        // Find the existing DoctorSchedule instance by its ID
        $doctorSchedule = DoctorSchedule::find($id);

        // If the DoctorSchedule instance exists
        if ($doctorSchedule) {
            // Update its attributes with the values from the request
            $doctorSchedule->doctor_id = $request->doctor_id;
            $doctorSchedule->senin = $request->senin;
            $doctorSchedule->selasa = $request->selasa;
            $doctorSchedule->rabu = $request->rabu;
            $doctorSchedule->kamis = $request->kamis;
            $doctorSchedule->jumat = $request->jumat;
            $doctorSchedule->sabtu = $request->sabtu;
            $doctorSchedule->minggu = $request->minggu;
            $doctorSchedule->status = $request->status;
            $doctorSchedule->note = $request->note;

            // Save the updated DoctorSchedule instance
            $doctorSchedule->save();

            return redirect()->route('doctor-schedules.index')->with('success', $doctorSchedule->doctor_id . ' Schedule updated successfully.');
        } else {
            // If the DoctorSchedule instance doesn't exist, redirect with an error message
            return redirect()->route('doctor-schedules.index')->with('error', 'Doctor schedule not found.');
        }
    }


    //delete
    public function destroy($id)
    {
        // DoctorSchedule::find($id)->delete();
        // return redirect()->route('doctor-schedules.index')->with('success',  $doctorSchedule->doctor_id . 'Schedule deleted .');

        $doctorSchedule = DoctorSchedule::find($id);

        if ($doctorSchedule) {
            $doctorSchedule->delete();
            return redirect()->route('doctor-schedules.index')->with('success',  'Doctor ID:' . $doctorSchedule->doctor_id   . ' schedule deleted successfully.');
        } else {
            return redirect()->route('doctor-schedules.index')->with('error', 'Doctor schedule not found.');
        }
    }
}
