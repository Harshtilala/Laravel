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

            <h3 class="text-center mb-4">Edit Class</h3>

            <form method="POST" action="{{ route('classes.update', $class->id) }}">
                @csrf
                @method('PUT')

                <!-- Class Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Class Name:</label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $class->name) }}" 
                           class="form-control" required>
                </div>

                <!-- Section Field -->
                <div class="mb-3">
                    <label for="section" class="form-label">Section Name:</label>
                    <select id="section" name="section" class="form-control" required>
                        <option value="">-- Select Section --</option>
                        <option value="A" {{ old('section', $class->section) == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('section', $class->section) == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('section', $class->section) == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('section', $class->section) == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>

                  <div class="mb-3">
                    <label class="form-label">Subjects:</label>
                    <select name="subject_id[]" id="subject_id" class="form-control subjects-select" multiple required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                @if(is_array(old('subject_id', $class->subject_id)) && in_array($subject->id, old('subject_id', $class->subject_id)))
                                    selected
                                @endif
                            >
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 my-3">Update</button>
                <a href="{{ route('classes.index') }}" class="btn btn-secondary w-100">Cancel</a>  

            </form>

        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('.subjects-select').select2({
            placeholder: "Select Subjects",
            allowClear: true
        });
    });
</script>

@endsection
