@extends('admin.master')
@section('content')
<div class="container">
    <h2>Student Report</h2>
    
    <form method="GET" action="{{ route('student-report') }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search by Email or ID" 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    @if(isset($students) && $students->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Group</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->student_email }}</td>
                <td>{{ $student->age ?? 'N/A' }}</td>
                <td>{{ $student->group_name ?? 'N/A' }}</td>
                <td>{{ $student->phone ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif(request('search'))
    <p>No students found.</p>
    @endif
</div>
@endsection