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

<div class="p-1 p-md-2 p-lg-3">
    <div class="card">
        <div class="card-header" style="background-color: #2c3e50; color: white;">
            <h5 class="card-title text-center mb-0">
                <i class="fa fa-plus-circle me-2"></i>
                Create New Review
            </h5>
        </div>

        <div class="card-body p-4">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form id="store_review" enctype="multipart/form-data">

                <!-- Basic Information -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-info-circle me-1"></i>Review Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user me-1"></i>Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-image me-1"></i>Image
                                </label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                                <div class="form-text">Accepted formats: JPG, JPEG, PNG</div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-heart me-1"></i>Appreciation <span class="text-danger">*</span>
                                </label>
                                <textarea rows="4" name="appreciation" class="form-control" placeholder="Write your appreciation..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end align-items-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">
                        <i class="fa fa-undo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn" style="background-color: #2c3e50; color: white;">
                        <i class="fa fa-save me-1"></i>Create Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function(){
    $("#store_review").on("submit", function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('store-review') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                if (response.status == 'success') {
                    $(".alert-container").html('<div class="alert alert-success alert-block">' +
                        '<button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<strong>' + response.message + '</strong>' +
                        '</div>');
                    $("#store_review")[0].reset();
                }
            },
            error: function(xhr, status, error){
                var errorMessage;
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else {
                    errorMessage = "Please Contact your Service Provider.";
                }
                
                $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                    '<button type="button" class="close" data-dismiss="alert">×</button>' +
                    '<strong>' + errorMessage + '</strong>' +
                    '</div>');
            }
        });
    });
});
</script>

