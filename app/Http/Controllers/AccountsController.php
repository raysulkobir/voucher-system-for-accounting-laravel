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
        return Accounts::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountsRequest $request)
    {
        //TODO Create and save the Product using validated data
        $accounts = Accounts::create($request->validated());

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'Accounts Type created successfully!',
            'data' => $accounts,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Accounts $accounts)
    {
        return response()->json($accounts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountsRequest $request, Accounts $accounts)
    {
        //TODO Update the Product with validated data
        $accounts->update($request->validated());

        //TODO Return a success response
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
        //TODO Delete the brand
        $accounts->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Accounts deleted successfully!',
        ], 200);
    }
}

