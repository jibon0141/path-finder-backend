@extends("admin.master")
@section("content")
    <section>
        <div class="p-1 p-md-2 p-lg-3">
            <div class="card input__main-card">
                <div style="background-color: #2c3e50; padding:5px 0px; color:white;">
                    <h5 class="card-title text-center fs-3">
                        <i class="fa fa-file-text me-2"></i>
                        Log Content: {{ $fileName }}
                    </h5>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <a href="{{ route('manage-logs') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-1"></i>Back to Logs
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search logs..." value="{{ $search }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <form method="GET">
                            <input type="hidden" name="search" value="{{ $search }}">
                            <select name="level" class="form-control" onchange="this.form.submit()">
                                <option value="">All Levels</option>
                                <option value="ERROR" {{ $level == 'ERROR' ? 'selected' : '' }}>Error</option>
                                <option value="WARNING" {{ $level == 'WARNING' ? 'selected' : '' }}>Warning</option>
                                <option value="INFO" {{ $level == 'INFO' ? 'selected' : '' }}>Info</option>
                                <option value="DEBUG" {{ $level == 'DEBUG' ? 'selected' : '' }}>Debug</option>
                            </select>
                        </form>
                    </div>
                </div>
                
                <div class="table_wrapper">
                    <table class="table table-striped">
                        <thead style="background-color: #2c3e50; color: white;">
                            <tr>
                                <th width="15%">Timestamp</th>
                                <th width="10%">Level</th>
                                <th width="75%">Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td><small>{{ $log['timestamp'] }}</small></td>
                                <td>
                                    <span class="badge 
                                        @if($log['level'] == 'ERROR') bg-danger
                                        @elseif($log['level'] == 'WARNING') bg-warning
                                        @elseif($log['level'] == 'INFO') bg-info
                                        @elseif($log['level'] == 'DEBUG') bg-secondary
                                        @else bg-primary
                                        @endif">
                                        {{ $log['level'] }}
                                    </span>
                                </td>
                                <td><small>{{ $log['message'] }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No logs found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pagination['last_page'] > 1)
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        Showing {{ count($logs) }} of {{ $pagination['total'] }} entries
                    </div>
                    <nav>
                        <ul class="pagination mb-0">
                            @if($pagination['current_page'] > 1)
                            <li class="page-item">
                                <a class="page-link" href="?page={{ $pagination['current_page'] - 1 }}&search={{ $search }}&level={{ $level }}">Previous</a>
                            </li>
                            @endif

                            @for($i = 1; $i <= $pagination['last_page']; $i++)
                            <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                <a class="page-link" href="?page={{ $i }}&search={{ $search }}&level={{ $level }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if($pagination['current_page'] < $pagination['last_page'])
                            <li class="page-item">
                                <a class="page-link" href="?page={{ $pagination['current_page'] + 1 }}&search={{ $search }}&level={{ $level }}">Next</a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection