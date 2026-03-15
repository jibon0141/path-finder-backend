@extends('admin.master')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Accounts List</h3>
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">Add New Account</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Account No</th>
                    <th>Account Name</th>
                    <th>Branch</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Default</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $account->account_no }}</td>
                    <td>{{ $account->account_name }}</td>
                    <td>{{ $account->branch_name ?? '-' }}</td>
                    <td>{{ number_format($account->balance, 2) }}</td>
                    <td>
                        <form action="{{ route('admin.accounts.status', $account->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $account->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $account->status ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        @if($account->is_default)
                            <span class="badge bg-primary">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.accounts.edit', $account->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
