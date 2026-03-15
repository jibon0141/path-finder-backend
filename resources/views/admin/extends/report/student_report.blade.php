@extends('admin.master')
@section('content')

<div class="alert-container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
</div>

<section>
    <div class="p-1 p-md-2 p-lg-3">
        <div class="card input__main-card">
            <div style="background-color: #2c3e50; padding:5px 0px; color:white;">
                <h5 class="card-title text-center fs-3">
                    <i class="fa fa-cogs me-2"></i>
                    Student Report
                </h5>
            </div>
        </div>

        <div class="card-body p-3">
            <form method="GET" action="{{ url('/student-report') }}">
                <div class="row align-items-end g-2">

                    <div class="col-md-3">
                        <label class="form-label small">Student Group</label>
                        <select name="student_group_id" class="form-control form-control-sm">
                            <option value="">Select Student Group</option>
                            @foreach($studentGroups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small">Student Name</label>
                        <input type="text" name="student_name" class="form-control form-control-sm" placeholder="Enter name">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">From Date</label>
                        <input type="date" name="from_date" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">To Date</label>
                        <input type="date" name="to_date" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm me-2 mt-1">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                        <button type="reset" class="btn btn-secondary btn-sm mt-1">
                            <i class="fa fa-refresh"></i> Reset
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<table id="student_table" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Group</th>
            <th>Subjects</th>
        </tr>
    </thead>
</table>

<!-- JQuery & DataTables Scripts -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#student_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('student-report') }}',
                data: function(d) {
                    d.student_group_id = $('select[name=student_group_id]').val();
                    d.student_name = $('input[name=student_name]').val();
                    d.from_date = $('input[name=from_date]').val();
                    d.to_date = $('input[name=to_date]').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'student_name', name: 'student_name' },
                { data: 'student_group', name: 'student_group' },
                { data: 'subjects', name: 'subjects' }
            ]
        });

        // Filter on form submit
        $('form').on('submit', function(e) {
            e.preventDefault();
            $('#student_table').DataTable().ajax.reload();
        });
    });
</script>
@endSection
