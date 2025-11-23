@extends("admin.master")
@section("content")
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
                        Manage Review
                    </h5>
                </div>
            </div>
            <div class="card-body table-responsive pt-2">
            <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="table_wrapper">
                    <table title="hello" id="review_table" class="table_default uv_table display responsive" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Appreciation</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include("admin.include.delete_confirmation")
    @include("admin.extends.review.update_review");
@endsection

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded",function(){
        //Show data in the Datatable start
        $("#review_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage-review') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return data ? `<img src="/picture/review_image/${data}" height="40" alt="No Image"/>` : 'No Image';
                    }
                },
                { 
                    data: 'appreciation', 
                    name: 'appreciation',
                    render: function (data, type, full, meta) {
                        return data.length > 50 ? data.substring(0, 50) + '...' : data;
                    }
                },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            error: function (xhr, error, code) {
                console.error('DataTables error:', error, code, xhr.responseText);
            },
        });
        // Show data in the Datatable end

        // Delete Review Modal Start
        $(document).ready(function () {
            let id;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.delete', function () {
                id = $(this).attr('id');
                $('#DeleteConfirmation-modal').modal('show');
            });

            $('#record-delete').click(function () {
                $.ajax({
                    url: `/delete-review/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    beforeSend: function () { $('#record-delete').text('Deleting...'); },
                    success: function (response) {
                        if (response.status == 'success') {
                            $('#DeleteConfirmation-modal').modal('hide');
                            $('#review_table').DataTable().ajax.reload();
                            alert(response.message);
                        }
                    },
                    complete: function () { $('#record-delete').text('Delete'); },
                    error: function (xhr) {
                        var errorMessage;
                        if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else {
                            errorMessage = "Please Contact your Service Provider.";
                        }
                        alert('Error: ' + errorMessage);
                    }
                });
            });
        });
        // Delete Review Modal End

        // Edit Review Modal Start
        $(document).ready(function() {
            $(document).on('click', '.edit-post', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `{{ route('edit-review', '') }}/${id}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const review = response.review;
                        $('#review_id').val(review.id);
                        $('#edit_name').val(review.name);
                        $('#edit_appreciation').val(review.appreciation);
                        $('#current_review_image').val(review.image);
                        
                        $('#edit_review_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        var errorMessage;
                        if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else {
                            errorMessage = "Please Contact your Service Provider.";
                        }
                        alert('Error: ' + errorMessage);
                    }
                });
            });
        });
        // Edit Review Modal End
    });
</script>