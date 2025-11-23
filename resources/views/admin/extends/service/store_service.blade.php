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
                Create New Service
            </h5>
        </div>

        <div class="card-body p-4">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form id="store_service" enctype="multipart/form-data">

                <!-- Basic Information -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-info-circle me-1"></i>Basic Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-tag me-1"></i>Service Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="service_name" class="form-control" placeholder="Enter Service Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-image me-1"></i>Service Image
                                </label>
                                <input type="file" name="service_image" class="form-control" accept="image/*">
                                <div class="form-text">Accepted formats: JPG, JPEG, PNG</div>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-align-left me-1"></i>Description <span class="text-danger">*</span>
                                </label>
                                <textarea rows="3" name="description" class="form-control" placeholder="Service Description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-list me-1"></i>Service Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-folder me-1"></i>Category <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-dollar-sign me-1"></i>Pricing <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="pricing" class="form-control" placeholder="e.g., $100 per session" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-clock me-1"></i>Duration <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="duration" class="form-control" placeholder="e.g., 1 hour" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user-md me-1"></i>Counselor <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="counselor" class="form-control" placeholder="Counselor Name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-plus-circle me-1"></i>Additional Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-certificate me-1"></i>Specialty <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="specialty" class="form-control" placeholder="Specialty Area" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-star me-1"></i>Rating <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" step="0.1" placeholder="Rating (1-5)" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-comments me-1"></i>Reviews <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="reviews" class="form-control" placeholder="Number of Reviews" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-map-marker-alt me-1"></i>Location <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="location" class="form-control" placeholder="Service Location" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-users me-1"></i>Capacity <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="capacity" class="form-control" placeholder="e.g., 10 people" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-list-ul me-1"></i>Features <span class="text-danger">*</span>
                                </label>
                                <textarea rows="3" name="features[]" class="form-control" placeholder="Enter features (one per line)" required></textarea>
                                <div class="form-text">Enter each feature on a new line</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end align-items-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">
                        <i class="fa fa-undo me-1"></i>Reset
                    </button>
                    <button type="submit" class="btn" style="background-color: #2c3e50; color: white;">
                        <i class="fa fa-save me-1"></i>Create Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function(){
    $("#store_service").on("submit", function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('store-service') }}",
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
                    $("#store_service")[0].reset();
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