@extends('layouts.master')
@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Class List</h2>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">Add Class</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('classes.index') }}" method="GET" class="mb-3">
                <div class="d-flex justify-content-end">
                    <div class="input-group w-25">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Class Name</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->section }}</td>
                            <td>
                                @if($class->subject_id)
                                @foreach ($class->subject_id as $sid)
                                <span class="badge bg-primary">{{ $subjects[$sid] ?? 'Unknown' }}</span>
                                @endforeach
                                @else
                                <span class="text-muted">No subjects</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('classes.edit', $class->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('classes.delete', $class->id) }}" method="post"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No classes found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $classes->appends(request()->all())->links('pagination::bootstrap-5') }}

                </div>
            </div>

        </div>
    </div>

</div>

@endsection