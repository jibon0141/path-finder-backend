<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="edit_category_modal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #2c3e50; color: white;">
                <h5 class="modal-title">
                    <i class="fa fa-edit me-2"></i>
                    Update Category
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="update_category_form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="current_category_image" id="current_category_image">
                
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-tag me-1"></i>
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg" name="category_name" id="category_name" 
                                   placeholder="Enter category name" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-image me-1"></i>
                                Category Image
                            </label>
                            <input type="file" class="form-control form-control-lg" name="category_image" id="category_image" 
                                   accept="image/jpeg,image/jpg,image/png">
                            <div class="form-text">
                                <i class="fa fa-info-circle me-1"></i>
                                Leave empty to keep current image. Accepted formats: JPG, JPEG, PNG
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-align-left me-1"></i>
                                Category Details <span class="text-danger">*</span>
                            </label>
                            <textarea rows="4" class="form-control" name="category_details" id="category_details" 
                                      placeholder="Enter detailed description of the category..." required></textarea>
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
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded",function(){
        $("#update_category_form").on("submit",function(e){
            e.preventDefault();
              const formData=new FormData(this);
              formData.append("_method","PUT");

              const id=$("#id").val();
              $.ajax({
                url:`/update-category/${id}`,
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:formData,
                processData:false,
                contentType:false,
                success:function(response){
                    if (response.status == 'success') {
                        $(".alert-container").html('<div class="alert alert-success alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>');
                        $("#edit_category_modal").modal('hide');
                        $("#category_table").DataTable().ajax.reload();
                    }
                },
                error:function(xhr, status, error){
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