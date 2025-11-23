<div id="edit_service_modal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #2c3e50; color: white;">
                <h5 class="modal-title">
                    <i class="fa fa-cogs me-2"></i>
                    Update Service
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="update_service_form" enctype="multipart/form-data">
                <input type="hidden" name="service_id" id="service_id">
                <input type="hidden" name="current_service_image" id="current_service_image">
                
                <div class="modal-body p-4">
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
                                    <input type="text" class="form-control" name="service_name" id="edit_service_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-image me-1"></i>Service Image
                                    </label>
                                    <input type="file" class="form-control" name="service_image" id="edit_service_image" accept="image/*">
                                    <div class="form-text">Leave empty to keep current image</div>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-align-left me-1"></i>Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea rows="3" class="form-control" name="description" id="edit_description" required></textarea>
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
                                    <select class="form-control" name="category_id" id="edit_category_id" required>
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-dollar-sign me-1"></i>Pricing <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="pricing" id="edit_pricing" placeholder="e.g., $100 per session" required>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-clock me-1"></i>Duration <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="duration" id="edit_duration" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-user-md me-1"></i>Counselor <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="counselor" id="edit_counselor" required>
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
                                    <input type="text" class="form-control" name="specialty" id="edit_specialty" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-star me-1"></i>Rating <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" name="rating" id="edit_rating" min="1" max="5" step="0.1" required>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-comments me-1"></i>Reviews <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" name="reviews" id="edit_reviews" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-map-marker-alt me-1"></i>Location <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="location" id="edit_location" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-users me-1"></i>Capacity <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="capacity" id="edit_capacity" placeholder="e.g., 10 people" required>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-list-ul me-1"></i>Features <span class="text-danger">*</span>
                                    </label>
                                    <textarea rows="3" class="form-control" name="features[]" id="edit_features" 
                                              placeholder="Enter features (one per line)" required></textarea>
                                    <div class="form-text">Enter each feature on a new line</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn" style="background-color: #2c3e50; color: white;">
                        <i class="fa fa-save me-1"></i>
                        Update Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    $("#update_service_form").on("submit", function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        const id = $("#service_id").val();
        formData.append('_method', 'PUT');
        
        $.ajax({
            url: `/update-service/${id}`,
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
                    $("#edit_service_modal").modal('hide');
                    $("#service_table").DataTable().ajax.reload();  
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
                alert('Error: ' + errorMessage);
            }
        });
    });
});
</script>