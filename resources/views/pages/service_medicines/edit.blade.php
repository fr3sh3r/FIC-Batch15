@extends('layouts.app')

@section('title', 'Edit Service and Medicine')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Service and Medicine</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Edit Service and Medicine</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('service-medicines.update', $service_medicines->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Service Medicines</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $service_medicines->name }}" placeholder="Enter item name"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control selectric @error('category') is-invalid @enderror"
                                    name="category" required>
                                    <option value="">Select category</option>
                                    <option value="medicine"
                                        {{ $service_medicines->category == 'medicine' ? 'selected' : '' }}>Obat-obatan
                                    </option>
                                    <option value="treatment"
                                        {{ $service_medicines->category == 'treatment' ? 'selected' : '' }}>Perawatan
                                    </option>
                                    <option value="consultation"
                                        {{ $service_medicines->category == 'consultation' ? 'selected' : '' }}>Konsultasi
                                        Dokter</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    name="price" value="{{ $service_medicines->price }}" placeholder="Enter Price"
                                    required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    name="quantity" value="{{ $service_medicines->quantity }}" placeholder="Enter quantity"
                                    required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{-- JS Libraries --}}
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
@endpush
