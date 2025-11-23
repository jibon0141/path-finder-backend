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
                System Optimization
            </h5>
        </div>

        <div class="card-body p-4">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- Cache Management -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fa fa-trash me-1"></i>Cache Management</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-danger optimization-btn" data-action="clear-cache">
                                    <i class="fa fa-trash me-1"></i>Clear Application Cache
                                </button>
                            </div>
                            <small class="text-muted">Clears all application cache files</small>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-warning optimization-btn" data-action="clear-config">
                                    <i class="fa fa-cog me-1"></i>Clear Config Cache
                                </button>
                            </div>
                            <small class="text-muted">Clears configuration cache</small>
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-info optimization-btn" data-action="clear-view">
                                    <i class="fa fa-eye me-1"></i>Clear View Cache
                                </button>
                            </div>
                            <small class="text-muted">Clears compiled view files</small>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-secondary optimization-btn" data-action="clear-route">
                                    <i class="fa fa-route me-1"></i>Clear Route Cache
                                </button>
                            </div>
                            <small class="text-muted">Clears route cache files</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Optimization -->
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fa fa-rocket me-1"></i>Application Optimization</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="d-grid">
                                <button type="button" class="btn optimization-btn" style="background-color: #2c3e50; color: white;" data-action="optimize-app">
                                    <i class="fa fa-rocket me-1"></i>Optimize Application
                                </button>
                            </div>
                            <small class="text-muted">Runs Laravel optimization commands (config:cache, route:cache, view:cache)</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Notice -->
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i>
                <strong>Warning:</strong> These operations may temporarily affect application performance. Use during maintenance windows when possible.
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function(){
    $(".optimization-btn").on("click", function(){
        const action = $(this).data('action');
        const button = $(this);
        const originalText = button.html();
        
        button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i>Processing...');
        
        $.ajax({
            url: `{{ url('/') }}/${action}`,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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
                if (xhr.status === 500 && xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else {
                    errorMessage = "Please Contact your Service Provider.";
                }
                
                $(".alert-container").html('<div class="alert alert-danger alert-block">' +
                    '<button type="button" class="close" data-dismiss="alert">×</button>' +
                    '<strong>' + errorMessage + '</strong>' +
                    '</div>');
            },
            complete: function(){
                button.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>