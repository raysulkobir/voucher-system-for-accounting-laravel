<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Http\Requests\StoreLedgerRequest;
use App\Http\Requests\UpdateLedgerRequest;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ledger::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLedgerRequest $request)
    {
        //TODO Create and save the Product using validated data
        return $ledger = Ledger::create($request->validated());

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'ledger created successfully!',
            'data' => $ledger,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $ledger)
    {
        return response()->json($ledger);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLedgerRequest $request, Ledger $ledger)
    {
        //TODO Update the Product with validated data
        $ledger->update($request->validated());

        //TODO Return a success response
        return response()->json([
            'message' => 'Ledger updated successfully!',
            'data' => $ledger,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ledger $ledger)
    {
        //TODO Delete the brand
        $ledger->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Ledger deleted successfully!',
        ], 200);
    }
}
