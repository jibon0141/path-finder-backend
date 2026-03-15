@extends('admin.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Account</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="account_no" class="form-label">Account No</label>
                <input type="text" class="form-control @error('account_no') is-invalid @enderror" id="account_no" name="account_no" value="{{ old('account_no', $account->account_no) }}" required>
                @error('account_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="account_name" class="form-label">Account Name</label>
                <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" name="account_name" value="{{ old('account_name', $account->account_name) }}" required>
                @error('account_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="branch_name" class="form-label">Branch Name</label>
                <input type="text" class="form-control @error('branch_name') is-invalid @enderror" id="branch_name" name="branch_name" value="{{ old('branch_name', $account->branch_name) }}">
                @error('branch_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="opening_balance" class="form-label">Opening Balance</label>
                <input type="number" step="0.01" class="form-control @error('opening_balance') is-invalid @enderror" id="opening_balance" name="opening_balance" value="{{ old('opening_balance', $account->opening_balance) }}" readonly>
                <div class="form-text">Opening balance cannot be changed after creation.</div>
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', $account->status) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="is_default" value="0">
                <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1" {{ old('is_default', $account->is_default) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_default">Is Default Account</label>
            </div>

            <button type="submit" class="btn btn-primary">Update Account</button>
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
