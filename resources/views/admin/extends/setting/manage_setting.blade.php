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
                <i class="fa fa-cogs me-2"></i>
                Environment Settings
            </h5>
        </div>

        <div class="card-body p-4">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <form id="update_setting" method="POST">
                @csrf
                @method('PUT')

                <!-- Application Settings -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-desktop me-1"></i>Application Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-tag me-1"></i>App Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="app_name" class="form-control" value="{{ $envData['app_name'] }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-environment me-1"></i>Environment <span class="text-danger">*</span>
                                </label>
                                <select name="app_env" class="form-control" required>
                                    <option value="local" {{ $envData['app_env'] == 'local' ? 'selected' : '' }}>Local</option>
                                    <option value="production" {{ $envData['app_env'] == 'production' ? 'selected' : '' }}>Production</option>
                                    <option value="staging" {{ $envData['app_env'] == 'staging' ? 'selected' : '' }}>Staging</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-bug me-1"></i>Debug Mode <span class="text-danger">*</span>
                                </label>
                                <select name="app_debug" class="form-control" required>
                                    <option value="true" {{ $envData['app_debug'] == 'true' ? 'selected' : '' }}>True</option>
                                    <option value="false" {{ $envData['app_debug'] == 'false' ? 'selected' : '' }}>False</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-link me-1"></i>App URL <span class="text-danger">*</span>
                                </label>
                                <input type="url" name="app_url" class="form-control" value="{{ $envData['app_url'] }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Database Settings -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-database me-1"></i>Database Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-server me-1"></i>Host <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="db_host" class="form-control" value="{{ $envData['db_host'] }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-plug me-1"></i>Port <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="db_port" class="form-control" value="{{ $envData['db_port'] }}" required>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-database me-1"></i>Database Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="db_database" class="form-control" value="{{ $envData['db_database'] }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user me-1"></i>Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="db_username" class="form-control" value="{{ $envData['db_username'] }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mail Settings -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fa fa-envelope me-1"></i>Mail Settings</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-server me-1"></i>Mail Host
                                </label>
                                <input type="text" name="mail_host" class="form-control" value="{{ $envData['mail_host'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-plug me-1"></i>Mail Port
                                </label>
                                <input type="number" name="mail_port" class="form-control" value="{{ $envData['mail_port'] }}">
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user me-1"></i>Mail Username
                                </label>
                                <input type="text" name="mail_username" class="form-control" value="{{ $envData['mail_username'] }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-envelope me-1"></i>From Address
                                </label>
                                <input type="email" name="mail_from_address" class="form-control" value="{{ $envData['mail_from_address'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn" style="background-color: #2c3e50; color: white;">
                        <i class="fa fa-save me-1"></i>Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function(){
    $("#update_setting").on("submit", function(e){
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: "{{ route('update-setting') }}",
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