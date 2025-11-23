@extends("admin.master")
@section("content")
    <div class="alert-container">
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>

        @endif
    </div>

    <div class="p-1 p-md-2 p-lg-3">
        <div class="card secondary-bg">
            <div class="card-header">
                <h5 class="card-title text-center">Store Admin</h5>
            </div>

            <div class="card-body">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <form id="store_admin" enctype="multipart/form-data">
                    <fieldset class="mb-3">

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Name <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name" id="name" class="form-control" required=""
                                       placeholder="Enter The Name">
                            </div>
                        </div>
                        <!-- /basic text input -->

                        <!-- Basic text input -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Email <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="email" name="email" id="email" class="form-control" required=""
                                       placeholder="Enter A Valid Email Address ">
                            </div>
                        </div>
                        <!-- /basic text input -->

                        <!-- Password field -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Password <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="password" name="password" id="password" class="form-control"
                                       required="" placeholder="Enter The Pssword">
                            </div>
                        </div>
                        <!-- /password field -->

                        <!-- Email field -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Contact Number <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control"
                                       required=""
                                       placeholder="Enter A Valid Mobile Number">
                            </div>
                        </div>
                        <!-- /email field -->

                        <!-- Basic textarea -->
                        <!--       <div class="form-group row">
                                  <label class="col-form-label col-lg-3">Basic textarea <span
                                          class="text-danger">*</span></label>
                                  <div class="col-lg-9">
                                      <textarea rows="5" cols="5" name="textarea" class="form-control" required=""
                                          placeholder="Default textarea"></textarea>
                                  </div>
                              </div> -->
                        <!-- /basic textarea -->

                        <!-- Styled file uploader -->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Picture <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <div class="custom-file">
                                    <input type="file" name="picture" id="picture" class="custom-file-input required"
                                    >
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <!-- /styled file uploader -->
                    </fieldset>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="reset" class="btn btn-danger me-3" id="reset">Reset <i
                                    class="icon-reload-alt ml-2"></i></button>
                        <button type="submit" class="btn btn-primary ml-3">Submit <i
                                    class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {

        // Admin Registration Part Start
        $("#store_admin").on("submit", function (e) {
            e.preventDefault();

            var formData = new FormData();

            formData.append("name", $("#name").val());
            formData.append("email", $("#email").val());
            formData.append("password", $("#password").val());
            formData.append("mobile_number", $("#mobile_number").val());
            formData.append("picture", $("#picture")[0].files[0]);
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: '/admin/store-admin',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    if (response.status == 'success') {
                        $(".alert-container").html('<div class="alert alert-success alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>');
                    }

                },
                error: function (xhr, status, error) {
                    // var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                       var errorMessage="Admin Registration UnSuccessful!";
                        $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + errorMessage + '</strong>' +
                            '</div>');
                }
            });
        });
        // Admin Registration Part End

    });


</script>