@extends('layouts.app')

@section('title', 'Add Schedules')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <!-- Style for the table -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Doctor Schedules</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Schedules</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Schedules</h2>

                <div class="card">
                    <form id="scheduleForm" action="{{ route('doctor-schedules.store') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Doctor Schedules</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Doctor Name</label>
                                <select class="form-control selectric @error('doctor_id') is-invalid @enderror"
                                    name="doctor_id">
                                    <option value="">Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="day">Day:</label>
                                <select class="form-control" id="day" name="day">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" id="time" name="time">
                            </div>

                            <div class="form-group mb-0">
                                <label>Note</label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Active" class="selectgroup-input"
                                            checked="">
                                        <span class="selectgroup-button">Active</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="Inactive" class="selectgroup-input">
                                        <span class="selectgroup-button">Inactive</span>
                                    </label>
                                </div>
                            </div>

                            <button id="addScheduleBtn" class="btn btn-primary">Add Schedule</button>
                            <table id="scheduleTable">
                                <thead>
                                    <tr>
                                        <th>Doctor Name</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody id="scheduleBody"></tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button id="submitBtn" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addScheduleBtn = document.getElementById('addScheduleBtn');
            const scheduleBody = document.getElementById('scheduleBody');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('scheduleForm');
            const schedules = []; // Array to store added schedules

            addScheduleBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Get schedule data from form fields
                const doctorName = document.querySelector('select[name="doctor_id"]').selectedOptions[0]
                    .textContent;
                const day = document.getElementById('day').value;
                const time = document.getElementById('time').value;
                const status = document.querySelector('input[name="status"]:checked').value;
                const note = document.querySelector('textarea[name="note"]').value;

                // Create a new row for the schedule table
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>${doctorName}</td>
                <td>${day}</td>
                <td>${time}</td>
                <td>${status}</td>
                <td>${note}</td>
            `;

                // Append the new row to the table body
                scheduleBody.appendChild(newRow);

                // Add the schedule data to the schedules array
                schedules.push({
                    doctorName: doctorName,
                    day: day,
                    time: time,
                    status: status,
                    note: note
                });
            });

            submitBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Convert the schedules array to JSON and set it as a value of a hidden input in the form
                const jsonData = JSON.stringify(schedules);
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'schedules';
                hiddenInput.value = jsonData;
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            });
        });
    </script>
@endpush
