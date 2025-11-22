@extends('layouts.master')
@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">   
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2 class="text-center mb-4">Student Details</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('student.create') }}" class="btn btn-primary">
            Add New Student
        </a>
    </div>

    

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('student.list') }}" method="GET" class="mb-3">
                <div class="d-flex justify-content-end">
                    <div class="input-group w-25">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
       
        <div class="card-body">

            <table class="table table-bordered table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>E-Mail</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($student as $stud)
                    <tr>
                        <td>{{ $stud->id }}</td>
                        <td>{{ $stud->roll_number }}</td>
                        <td>{{ $stud->name }}</td>
                        <td>{{ $stud->contact->contact_no}}</td>
                        <td>{{ $stud->contact->email }}</td>

                        <td>
                            <a href="{{ route('student.edit',$stud->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('student.destroy', $stud->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this student?')"> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
              {{ $student->appends(request()->all())->links('pagination::bootstrap-5') }}

            </div>

        </div>
    </div>
</div>

@endsection