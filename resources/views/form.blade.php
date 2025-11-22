@extends('layouts.master')
@section('content')

    <div class="container mt-5">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-body">

                <h3 class="text-center mb-4">Student Information Form</h3>

                <form action="{{ route('student.store') }}" method="POST">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter name" required>
                    </div>

                    <!-- Roll Number Field -->
                    <div class="mb-3">
                        <label for="roll_number" class="form-label">Roll Number:</label>
                        <input type="number" id="roll_number" name="roll_number" value="{{ old('roll_number') }}" class="form-control"
                            placeholder="Enter roll number" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_no" class="form-label">Contact Number</label>
                        <input type="tel" id="contact_no" name="contact_no" class="form-control"
                            placeholder="Enter Contact Number" value="{{ old('contact_no') }}" maxlength="10"  required>
                    </div> 
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Enter email" required>
                    </div>
                   
                    <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                      <a href="{{ route('student.list') }}" class="btn btn-secondary w-100">Cancel</a>  
                </form>

            </div>
        </div>

    </div>

    @endsection