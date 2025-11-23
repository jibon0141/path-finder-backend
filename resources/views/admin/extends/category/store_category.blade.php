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
        <div class="card secondary-bg">
            <div class="card-header" style="background-color: #2c3e50; color: white;">
                <h5 class="card-title text-center mb-0">
                    <i class="fa fa-plus-circle me-2"></i>
                    Create New Category
                </h5>
            </div>

            <div class="card-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form id="store_category" enctype="multipart/form-data">
                    <fieldset class="mb-3">

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Category Name <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="category_name" id="category_name" class="form-control"
                                       placeholder="Enter A Category Name" required>
                            </div>
                        </div>
                        <!-- /basic text input -->

                        <!-- Email field -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Category Image <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="file" name="category_image" id="category_image" class="form-control"
                                       required=""
                                       placeholder="Enter A Category Image" required>
                            </div>
                        </div>
                        <!-- /email field -->

                        <!-- Basic textarea -->
                            <div class="form-group row">
                                  <label class="col-form-label col-lg-3">Category Details <span
                                          class="text-danger">*</span></label>
                                  <div class="col-lg-9">
                                      <textarea rows="5" cols="5" name="category_details" id="category_details" class="form-control" required=""
                                          placeholder="Category Details" required></textarea>
                                  </div>
                              </div>
                        <!-- /basic textarea -->

                        <!-- /styled file uploader -->
                    </fieldset>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="reset" class="btn btn-danger me-3" id="reset">Reset <i
                                    class="icon-reload-alt ml-2"></i></button>
                        <button type="submit" class="btn ml-3" style="background-color: #2c3e50; color: white;">Submit <i
                                    class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded",function(){

        $("#store_category").on("submit",function(e){
            e.preventDefault();

            const formData=new FormData();
            formData.append("category_name", $("#category_name").val());
            formData.append("category_details", $("#category_details").val());
            formData.append("category_image", $("#category_image")[0].files[0]);


            $.ajax({
                url:"/store-category",
                method:"POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:formData,
                processData:false,
                contentType:false,
               success: function(response) {
                 if (response.status == 'success') {
                  $(".alert-container").html(
                '<div class="alert alert-success alert-block">' +
                '<button type="button" class="close" data-dismiss="alert">×</button>' +
                '<strong>' + response.message + '</strong>' +
                '</div>'   
                 );

                document.getElementById("store_category").reset();
                }
                },
                error:function(xhr,status,error){
                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.error) {
                        var errorMessage = xhr.responseJSON.message + "<br>";
                        var errors = xhr.responseJSON.error;
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                 // errorMessage += "- " + errors[field].join(", ") + "<br>";
                            }
                        }
                    } else if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.message) {
                         // var errorMessage = "Generic Error. Code: " + xhr.status + " - " + xhr.responseJSON.message;
                         var errorMessage=xhr.responseJSON.message;
                    }else{
                        var errorMessage="Please Contact your Service Provider.";
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
