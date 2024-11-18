<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Http\Requests\StoreAccountsRequest;
use App\Http\Requests\UpdateAccountsRequest;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Accounts::latest()->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountsRequest $request)
    {
        $accounts = Accounts::create($request->validated());

        return response()->json([
            'message' => 'Accounts created successfully!',
            'data' => $accounts,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Accounts $accounts)
    {
        return response()->json(['data' => $accounts], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountsRequest $request, Accounts $accounts)
    {
        $accounts->update($request->validated());

        return response()->json([
            'message' => 'Accounts updated successfully!',
            'data' => $accounts,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accounts $accounts)
    {
        $accounts->delete();

        return response()->json([
            'message' => 'Accounts deleted successfully!',
        ], 200);
    }
}
