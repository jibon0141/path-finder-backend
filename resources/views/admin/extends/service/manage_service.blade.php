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
                        Manage Service
                    </h5>
                </div>
            </div>
            <div class="card-body table-responsive pt-2">
            <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="table_wrapper">
                    <table title="hello" id="service_table" class="table_default uv_table display responsive" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Service Image</th>
                            <th>Category</th>
                            <th>Pricing</th>
                            <th>Duration</th>
                            <th>Counselor</th>
                            <th>Specialty</th>
                            <th>Rating</th>
                            <th>Reviews</th>
                            <th>Location</th>
                            <th>Capacity</th>
                            <th>Created at</th>
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
    @include("admin.extends.service.update_service");
@endsection

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded",function(){
        //Show data in the Datatable start
        $("#service_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('manage-service') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'service_name', name: 'service_name' },
                {
                    data: 'service_image',
                    name: 'service_image',
                    render: function (data, type, full, meta) {
                        return data ? `<img src="/picture/service_image/${data}" height="40" alt="No Image"/>` : 'No Image';
                    }
                },
                { data: 'category_name', name: 'category_name' },
                { data: 'pricing', name: 'pricing' },
                { data: 'duration', name: 'duration' },
                { data: 'counselor', name: 'counselor' },
                { data: 'specialty', name: 'specialty' },
                { data: 'rating', name: 'rating' },
                { data: 'reviews', name: 'reviews' },
                { data: 'location', name: 'location' },
                { data: 'capacity', name: 'capacity' },
                { data: 'created_at', name: 'created_at' },
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

        // Delete Service Modal
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
                    url: `/delete-service/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    beforeSend: function () { $('#record-delete').text('Deleting...'); },
                    success: function () {
                        $('#DeleteConfirmation-modal').modal('hide');
                        $('#service_table').DataTable().row($(`.delete[id="${id}"]`).closest('tr')).remove().draw();
                        alert('Service deleted successfully!');
                    },
                    complete: function () { $('#record-delete').text('Delete'); },
                    error: function (xhr) {
                        console.error(`Error ${xhr.status}: ${xhr.statusText}`);
                    }
                });
            });
        });

        // Edit Service Modal
        $(document).ready(function() {
            $(document).on('click', '.edit-post', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/edit-service/${id}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const service = response.service;
                        $('#service_id').val(service.id);
                        $('#edit_service_name').val(service.service_name);
                        $('#edit_description').val(service.description);
                        $('#edit_category_id').val(service.category_id);
                        $('#edit_pricing').val(service.pricing);
                        $('#edit_duration').val(service.duration);
                        $('#edit_counselor').val(service.counselor);
                        $('#edit_specialty').val(service.specialty);
                        $('#edit_rating').val(service.rating);
                        $('#edit_reviews').val(service.reviews);
                        $('#edit_location').val(service.location);
                        $('#edit_capacity').val(service.capacity);
                        $('#current_service_image').val(service.service_image);
                        if(service.features) {
                            let features = JSON.parse(service.features);
                            $('#edit_features').val(Array.isArray(features) ? features.join('\n') : service.features);
                        }
                        
                        // Populate categories dropdown
                        $('#edit_category_id').empty().append('<option value="">Select Category</option>');
                        response.categories.forEach(function(cat) {
                            $('#edit_category_id').append(`<option value="${cat.id}" ${cat.id == service.category_id ? 'selected' : ''}>${cat.category_name}</option>`);
                        });
                        
                        $('#edit_service_modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(`Error: ${status} - ${error}`);
                    }
                });
            });
        });

    });
</script>