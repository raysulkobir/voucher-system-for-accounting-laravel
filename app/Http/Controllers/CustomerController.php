<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //TODO Create and save the Product using validated data
        $customer = Customer::create($request->validated());

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'Customer created successfully!',
            'data' => $customer,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //TODO Update the Product with validated data
        $customer->update($request->validated());

        //TODO Return a success response
        return response()->json([
            'message' => 'Customer updated successfully!',
            'data' => $customer,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //TODO Delete the brand
        $customer->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Customer deleted successfully!',
        ], 200);
    }
}
