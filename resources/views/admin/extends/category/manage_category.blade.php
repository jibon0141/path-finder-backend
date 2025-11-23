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
                        Manage Category
                    </h5>
                </div>
            </div>
            <div class="card-body table-responsive pt-2">
                <div class="table_wrapper">
                    <table title="hello" id="category_table" class="table_default uv_table display responsive" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Category Details</th>
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
    @include("admin.extends.category.update_category")
@endsection

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded",function(){
        //Show data in the Datatable start
        $("#category_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage-category') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'category_name', name: 'category_name' },
                {
                    data: 'category_image',
                    name: 'category_image',
                    render: function (data, type, full, meta) {
                        return `<img src="/picture/category_image/${data}" height="40" alt="No Image"/>`;
                    }
                },
                { data: 'category_details', name: 'category_details' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            // dom: 'Bfrtip', // Adds buttons above the table
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print' // Export options
            // ],
            error: function (xhr, error, code) {
                console.error('DataTables error:', error, code, xhr.responseText);
            },

        });
        // Show data in the Datatable end

        //Delete Category Modal Start
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
                    url: `/delete-category/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    beforeSend: function () { $('#record-delete').text('Deleting...'); },
                    success: function () {
                        $('#DeleteConfirmation-modal').modal('hide');
                        $('#category_table').DataTable().row($(`.delete[id="${id}"]`).closest('tr')).remove().draw();
                        alert('Category deleted successfully!');
                    },
                    complete: function () { $('#record-delete').text('Delete'); },
                    error: function (xhr) {
                        console.error(`Error ${xhr.status}: ${xhr.statusText}`);
                    }
                });
            });
        });
        //Delete Category Modal End
 

        //Show Category Modal Start
        $(document).ready(function() {
            $(document).on('click', '.edit-post', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/edit-category/${id}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#id').val(response.id);
                        $('#category_name').val(response.category_name);
                        $('#category_details').val(response.category_details);
                        $('#current_category_image').val(response.category_image);
                        $('#category_image').val('');
                        $('#edit_category_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(`Error: ${status} - ${error}`);
                    }
                });
            });
        });
        //Show Category Modal End




    });
</script>
