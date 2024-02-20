<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('admin');

        return view('dashboard.account.index', [
            'accounts' => User::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $account)
    {
        return view('dashboard.account.edit', [
            'accounts' => $account,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $account)
    {
        $rules = [
            'isAdmin' => 'required|boolean',
            'name' => 'required',
            'email' => 'required|email:dns',
        ];

        if ($request->name != $account->name) {
            $rules['name'] = 'required|unique:users';
        }

        if ($request->email != $account->email) {
            $rules['email'] = 'required|unique:users|email:dns';
        }

        $validated = $request->validate($rules);

        User::where('id', $account->id)
            ->update($validated);

        return redirect('dashboard/account')->with('success', 'Data akun berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $account)
    {
        User::destroy($account->id);

        return redirect('dashboard/account')->with('success', 'Akun berhasil dihapus.');
    }
}
