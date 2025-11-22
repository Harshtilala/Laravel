@extends('layouts.master')
@section('content')

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-body">
            <h3 class="text-center mb-4">Subjects List</h3>

            <div class="mb-3 text-end">
                <a href="{{ route('subjects.create') }}" class="btn btn-success">Add New Subject</a>
            </div>

            <table class="table table-bordered" id="subjects-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Datatables JS -->

<script>
    $(function() {
    $('#subjects-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subjects.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });
});
</script>

@endsection