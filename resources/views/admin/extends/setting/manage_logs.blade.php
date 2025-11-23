@extends("admin.master")
@section("content")
    <section>
        <div class="p-1 p-md-2 p-lg-3">
            <div class="card input__main-card">
                <div style="background-color: #2c3e50; padding:5px 0px; color:white;">
                    <h5 class="card-title text-center fs-3">
                        <i class="fa fa-file-text me-2"></i>
                        System Logs
                    </h5>
                </div>
            </div>
            <div class="card-body table-responsive pt-2">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" id="logSearch" class="form-control" placeholder="Search logs...">
                    </div>
                    <div class="col-md-6">
                        <select id="levelFilter" class="form-control">
                            <option value="">All Levels</option>
                            <option value="ERROR">Error</option>
                            <option value="WARNING">Warning</option>
                            <option value="INFO">Info</option>
                            <option value="DEBUG">Debug</option>
                        </select>
                    </div>
                </div>
                
                <div class="table_wrapper">
                    <table id="log_files_table" class="table_default uv_table display responsive" width="100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>File Name</th>
                            <th>Size</th>
                            <th>Last Modified</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($logFiles as $file)
                            <tr>
                                <td>{{ $file['date'] }}</td>
                                <td>{{ $file['name'] }}</td>
                                <td>{{ $file['size'] }}</td>
                                <td>{{ $file['last_modified'] }}</td>
                                <td>
                                    <a href="{{ route('view-log', $file['name']) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


@endsection

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        // Initialize DataTable for log files
        $("#log_files_table").DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
            responsive: true
        });

        // View log content
        $(document).on('click', '.view-log', function() {
            const fileName = $(this).data('file');
            $('#logFileName').text(fileName);
            
            $.ajax({
                url: `{{ route('view-log', '') }}/${fileName}`,
                type: 'GET',
                beforeSend: function() {
                    $('#logContentBody').html('<tr><td colspan="3" class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</td></tr>');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        displayLogContent(response.logs);
                        $('#logContentModal').modal('show');
                    }
                },
                error: function(xhr) {
                    alert('Error loading log content');
                }
            });
        });

        // Display log content in table
        function displayLogContent(logs) {
            let html = '';
            logs.forEach(function(log) {
                const levelClass = getLevelClass(log.level);
                html += `<tr class="log-row" data-level="${log.level}" data-message="${log.message.toLowerCase()}">
                    <td><small>${log.timestamp}</small></td>
                    <td><span class="badge ${levelClass}">${log.level}</span></td>
                    <td><small>${log.message}</small></td>
                </tr>`;
            });
            $('#logContentBody').html(html);
        }

        // Get CSS class for log level
        function getLevelClass(level) {
            switch(level) {
                case 'ERROR': return 'bg-danger';
                case 'WARNING': return 'bg-warning';
                case 'INFO': return 'bg-info';
                case 'DEBUG': return 'bg-secondary';
                default: return 'bg-primary';
            }
        }

        // Search functionality for log content
        $('#logContentSearch, #logLevelFilter').on('input change', function() {
            const searchTerm = $('#logContentSearch').val().toLowerCase();
            const levelFilter = $('#logLevelFilter').val();
            
            $('.log-row').each(function() {
                const row = $(this);
                const message = row.data('message');
                const level = row.data('level');
                
                const matchesSearch = searchTerm === '' || message.includes(searchTerm);
                const matchesLevel = levelFilter === '' || level === levelFilter;
                
                if (matchesSearch && matchesLevel) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });

        // Search functionality for log files
        $('#logSearch').on('input', function() {
            $("#log_files_table").DataTable().search(this.value).draw();
        });
    });
</script>