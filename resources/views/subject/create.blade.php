@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Add Subject</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf

                <!-- Subject Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" id="name" name="name" class="form-control" 
                        value="{{ old('name') }}" placeholder="Enter subject name" required>
                </div>

              

                <button type="submit" class="btn btn-primary w-100">Add Subject</button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection
