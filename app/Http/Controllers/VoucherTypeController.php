<?php

namespace App\Http\Controllers;

use App\Models\VoucherType;
use App\Http\Requests\StoreVoucherTypeRequest;
use App\Http\Requests\UpdateVoucherTypeRequest;

class VoucherTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VoucherType::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherTypeRequest $request)
    {
        //TODO Create and save the Product using validated data
        $voucherType = VoucherType::create($request->validated());

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'Voucher Type created successfully!',
            'data' => $voucherType,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VoucherType $voucherType)
    {
        return response()->json($voucherType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherTypeRequest $request, VoucherType $voucherType)
    {
        //TODO Update the Product with validated data
        $voucherType->update($request->validated());

        //TODO Return a success response
        return response()->json([
            'message' => 'Voucher Type updated successfully!',
            'data' => $voucherType,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VoucherType $voucherType)
    {
        //TODO Delete the brand
        $voucherType->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Voucher Type deleted successfully!',
        ], 200);
    }
}

