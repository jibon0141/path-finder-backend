@extends("admin.master")
@include('admin.include.support',['data'=>['validation_jquery','summernote','data_table']])
@section("content")
    <div class="alert-container">
        @if ($message = Session::get('message'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
    </div>
    <div class="px-3 px-xl-4 profile-section" id="total_container">
        <div class="row g-4">
            <div class="col-xl-4">
                <div class="card profile-card">
                    <div class="card-header text-center">
                        <h6>Admin Profile</h6>
                    </div>
                <!-- <form id="update_profile_picture"  action="{{url('/admin/update-profile-picture')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                @method("PUT") -->
                    <form id="update_profile_picture" enctype="multipart/form-data">
                        @method("PUT")
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="card-body text-center secondary-bg primary-text pt-5">
                            <div class="profile-avatar rounded-circle overflow-hidden mx-auto"
                                 style="width: 150px; height: 150px;">
                                <img src="{{ asset('picture/admin_picture/' . (!empty($profile->picture) ? $profile->picture : '1733574632_about.jpg')) }}"
                                     alt="Profile Picture" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                        <h4 class="my-3 text-center">{{ (!empty($profile->name) ? $profile->name : App\Models\Admin::default_admin['name']) }}</h4>
                        <div class="custom-file d-flex justify-content-center align-items-center" style="gap: 8px;">
                            <!-- Submit button (4/5 width) -->
                            <button type="submit" class="btn btn-primary text-white"
                                    style="flex: 4; padding: 10px 20px; border: none;">
                                <i class="fa-solid fa-cloud-arrow-up"></i> Update Photo
                            </button>

                            <!-- File input (1/5 width) -->
                            <div class="mt-2" style="flex: 1; position: relative;">
                                <input type="file" name="picture" id="picture"
                                       style="opacity: 0; width: 100%; height: 100%; position: absolute; cursor: pointer;">
                                <label for="picture" style="display: flex; padding: 10px 20px; justify-content: center; align-items: center; width: 100%; height: 100%;
                    background-color: #007bff; color: white; text-align: center; padding: 10px; border: none; border-radius: 0.25rem; cursor: pointer;">
                                    Browse
                                </label>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-5">
                    <div class="card-header text-center">
                        <h6>Profile Details</h6>
                    </div>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <form id="profile_details" class="card-body secondary-bg primary-text pt-5">

                        <div class="row">
                            <div class="input-group mb-3 col">
                                <label class="input-label">User name</label>
                                <input class="input" type="text"
                                       value="{{(!empty($profile->name) ? $profile->name : App\Models\Admin::default_admin['name'] )}}"
                                       id="name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb-3 col">
                                    <label class="input-label">Email</label>
                                    <input class="input" type="email" placeholder="Email  address"
                                           value="{{(!empty($profile->email) ? $profile->email : App\Models\Admin::default_admin['email'] )}}"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group mb-3 col">
                                    <label class="input-label">Phone </label>
                                    <input class="input" type="text" default="" placeholder="Phone Number"
                                           value="{{ (!empty($profile->mobile_number) ? $profile->mobile_number : App\Models\Admin::default_admin['mobile_number'] )}}"
                                           id="mobile_number">
                                </div>
                            </div>
                        </div>


                        <div class="mb-2 mt-3">
                            <button type="submit" id="update_details_button" class="btn btn-primary fw-bold ">Update
                                Details
                            </button>
                        </div>
                    </form>
                    <div class="card-header">
                        <h6>Change Password</h6>
                    </div>
                <!-- <form id="update_password" action="{{ url('/admin/update-admin-password') }}" method="POST"
                          class="card-body secondary-bg primary-text pt-5">
                        @csrf
                @method('PUT') -->
                    <form id="update_password"
                          class="card-body secondary-bg primary-text pt-5">
                        <div class="row">
                            <div class="input-group mb-3 col-12">
                                <label class="input-label">Old Password</label>
                                <input class="input" type="password" placeholder="Old Password" name="password"
                                       id="password" required minlength="6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3 ">
                                    <label class="input-label">New Password</label>
                                    <input class="input" type="password" placeholder="New Password" name="new_password"
                                           id="new_password" required minlength="6">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mb-3">
                                    <label class="input-label">Confirm Password</label>
                                    <input class="input" type="password" placeholder="Confirm Password"
                                           name="confirm_password" id="confirm_password" required minlength="6">
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 mt-3">
                            <button type="submit" class="btn btn-primary fw-bold ">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {

        $("#update_profile_picture").on("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append("picture", $("#picture")[0].files[0]);

            $.ajax({
                url: "/admin/update-profile-picture",
                method: "POST",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') // Add CSRF token for Laravel
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $("#total_container").load(window.location.href + " #total_container");
                    if (response.status == 'success') {
                        $(".alert-container").html('<div class="alert alert-success alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    // console.error(xhr.responseText);
                    // var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                    var errorMessage="Picture Update Unsuccessful!";
                    $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                        '<button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<strong>' + errorMessage + '</strong>' +
                        '</div>');
                }
            });
        });

        // Update Profile Details Start
        $("#profile_details").on("submit", function (e) {
            e.preventDefault();

            let data = {
                name: $("#name").val(),
                mobile_number: $("#mobile_number").val()
            }

            $.ajax({
                url: "/admin/update-profile",
                method: "PUT",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (response) {
                    $("#total_container").load(window.location.href + " #total_container");
                    $("#profile_details")[0].reset();
                    if (response.status == 'success') {
                        $(".alert-container").html('<div class="alert alert-success alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    // console.error(xhr.responseText);
                    // var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                    var errorMessage="Profile Update Unsuccessful!";
                    $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                        '<button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<strong>' + errorMessage + '</strong>' +
                        '</div>');
                }
            });
        });
        // Update Profile Details End

        // Update Password Start
        $("#update_password").on("submit", function (e) {
            e.preventDefault();

            let data = {
                password: $("#password").val(),
                new_password: $("#new_password").val(),
                confirm_password: $("#confirm_password").val(),
            }

            $.ajax({
                url: "/admin/update-admin-password",
                method: "PUT",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function (response) {
                    $("#update_password")[0].reset();
                    if (response.status == 'success') {
                        $(".alert-container").html('<div class="alert alert-success alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>')
                    }
                    else{
                        $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                            '<strong>' + response.message + '</strong>' +
                            '</div>');
                    }
                },
                error: function (xhr, status, error) {
                    $("#update_password")[0].reset();
                    //var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred';
                     var errorMessage="Password Update Unsuccessful!";
                    $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                        '<button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<strong>' + errorMessage + '</strong>' +
                        '</div>');
                }
            });
        });
        //Updtate Password End
    });


</script>