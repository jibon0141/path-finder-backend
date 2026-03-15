<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = \App\Models\Account::latest()->get();
        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_no' => 'required|string|max:50|unique:accounts,account_no',
            'account_name' => 'required|string|max:100',
            'opening_balance' => 'required|numeric',
        ]);

        $input = $request->all();
        $input['balance'] = $input['opening_balance']; // Initially balance is same as opening balance

        \App\Models\Account::create($input);

        return redirect()->route('admin.accounts.index')->with('success', 'Account created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = \App\Models\Account::findOrFail($id);
        return view('admin.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'account_no' => 'required|string|max:50|unique:accounts,account_no,' . $id,
            'account_name' => 'required|string|max:100',
        ]);

        $account = \App\Models\Account::findOrFail($id);
        $account->update($request->all());

        return redirect()->route('admin.accounts.index')->with('success', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = \App\Models\Account::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Account deleted successfully.');
    }

    public function status($id)
    {
        $account = \App\Models\Account::findOrFail($id);
        $account->status = !$account->status;
        $account->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
