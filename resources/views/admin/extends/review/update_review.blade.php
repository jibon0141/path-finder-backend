<div id="edit_review_modal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #2c3e50; color: white;">
                <h5 class="modal-title">
                    <i class="fa fa-cogs me-2"></i>
                    Update Review
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="update_review_form" enctype="multipart/form-data">
                <input type="hidden" name="review_id" id="review_id">
                <input type="hidden" name="current_review_image" id="current_review_image">
                
                <div class="modal-body p-4">
                    <!-- Review Information -->
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
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-image me-1"></i>Image
                                    </label>
                                    <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
                                    <div class="form-text">Leave empty to keep current image</div>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-heart me-1"></i>Appreciation <span class="text-danger">*</span>
                                    </label>
                                    <textarea rows="4" class="form-control" name="appreciation" id="edit_appreciation" required></textarea>
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
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    $("#update_review_form").on("submit", function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        const id = $("#review_id").val();
        formData.append('_method', 'PUT');
        
        $.ajax({
            url: `/update-review/${id}`,
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
                    $("#edit_review_modal").modal('hide');
                    $("#review_table").DataTable().ajax.reload();
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

