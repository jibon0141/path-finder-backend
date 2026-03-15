<!-- jQuery FIRST -->
<!-- <script defer src="{{asset('assets/backend_assets/plugin/jquery-v3.6.1/jquery-3.6.1.min.js')}}"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Bootstrap (depends on jQuery only if using certain features) -->
<script defer src="{{asset('assets/backend_assets/plugin/bootstrap-v5.2.1/bootstrap.bundle.js')}}"></script>

<!-- Summernote (depends on jQuery) -->
<script defer src="{{asset('assets/backend_assets/plugin/summernote-v0.8.18/summernote-lite.min.js')}}"></script>

<!-- Toastify (independent) -->
<script defer src="{{asset('assets/backend_assets/plugin/toaster-v1.12.0/js/toastify-js.js')}}"></script>

<!-- SweetAlert2 (independent) -->
<script defer src="{{asset('assets/backend_assets/plugin/sweetalet2-v11/sweetalert2.min.js')}}"></script>

<!-- DataTables core -->
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/jquery.dataTables.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/dataTables.responsive.min.js')}}"></script>

<!-- DataTables export dependencies -->
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/jszip.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/pdfmake.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/vfs_fonts.js')}}"></script>

<!-- DataTables Buttons -->
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/dataTables.buttons.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/buttons.flash.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/buttons.html5.min.js')}}"></script>
<script defer src="{{asset('assets/backend_assets/plugin/datatable-v1.12.1/js/buttons.print.min.js')}}"></script>

<!-- Virtual Select -->
<script defer src="{{asset('assets/backend_assets/plugin/virtualselect-v1.0.31/virtual-select.min.js')}}"></script>

<!-- jQuery Validation -->
<script defer src="{{asset('assets/backend_assets/plugin/jqueryvalidate-v1.19.5/jquery.validate.min.js')}}"></script>

<!-- PNotify -->
<script defer src="{{asset('assets/backend_assets/plugin/pnotify-v5.2.0/js/PNotify.js')}}"></script>

<!-- Your JS files LAST -->
<script defer type="module" src="{{asset('assets/backend_assets/js/main.js')}}"></script>
<script defer type="module" src="{{asset('assets/backend_assets/js/custom.js')}}"></script>

@yield('script')
