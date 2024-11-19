<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Voucher::latest()->get()], 200);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $voucher = Voucher::create($request->validated());

        return response()->json([
            'message' => 'Voucher created successfully!',
            'data' => $voucher,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return response()->json(['data' => $voucher], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $voucher->update($request->validated());

        return response()->json([
            'message' => 'Voucher updated successfully!',
            'data' => $voucher,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return response()->json([
            'message' => 'Voucher deleted successfully!',
        ], 200);
    }
}
