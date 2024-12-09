<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Ledger;
use App\Models\Voucher;
use App\Models\SaleProduct;
use Illuminate\Support\Arr;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sale::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $validatedData = $request->validated();

        //TODO Except the validated data for further processing
        $productsData = Arr::only($validatedData, ['products']);
        $saleData = Arr::except($validatedData, ['products']);

        //TODO Create and save the Product using validated data
        $sale = Sale::create($saleData);

        foreach($productsData['products'] as $productsData){
            $saleProduct = new SaleProduct();
            $saleProduct->sale_id = $sale->id;
            $saleProduct->product_id = $productsData['product_id'];
            $saleProduct->quantity = $productsData['quantity'];
            $saleProduct->unit_price = $productsData['unit_price'];
            $saleProduct->total_price = $productsData['unit_price'] * $productsData['quantity'];
            $saleProduct->save();
        }

        //TODO Voucher Entries 

        //TODO Sales Voucher
        $saleVoucher = Voucher::create([
            'voucher_number' => "VCH-$sale->id",
            'account_id' => 1,
            'reference' => $sale->id,
            'amount' => $sale->grand_total,
            'voucher_type' => 6,
            'voucher_date' => Carbon::today(),
            'description' => "Sale Voucher",
            'created_by' => 1
        ]);

        $this->transliteratorCreate($saleVoucher, $transaction_type = 'sale');

        //TODO Receipt Voucher
        $remainingBalance = $sale->grand_total - $sale->paid_amount;
        if($remainingBalance > 0){
            $transactionReceiptVoucher = Voucher::create([
                'voucher_number' => "VCH-$sale->id",
                'account_id' => 1,
                'reference' => $sale->id,
                'amount' => $remainingBalance,
                'voucher_type' => 2,
                'voucher_date' => Carbon::today(),
                'description' => "Cash Received",
                'created_by' => 1
            ]);
            $this->transliteratorCreate($transactionReceiptVoucher, $transaction_type = 'payment');
        }

        // TODO Ledger Entries
        //! Sales Ledger Entry
        Ledger::create([
            'account_id' => 1,
            'transaction_id' => 1,
            'debit' => $sale->grand_total,
            'credit' => 0,
            'balance' => $sale->grand_total,
            'transaction_date' => Carbon::now(),
            'description' => 'Sale',
        ]);

        //! Cash Ledger Entry
        Ledger::create([
            'account_id' => 1,
            'transaction_id' => 1,
            'debit' => 0,
            'credit' => $sale->paid_amount,
            'balance' => $sale->paid_amount,
            'transaction_date' => Carbon::now(),
            'description' => 'Cash Received',
        ]);

        //! Cash Lader Receivable 
        $remainingBalance = $sale->grand_total - $sale->paid_amount;
        if($remainingBalance > 0){
            Ledger::create([
                'account_id' => 1,
                'transaction_id' => 1,
                'debit' => 0,
                'credit' => $remainingBalance,
                'balance' => $remainingBalance,
                'transaction_date' => Carbon::now(),
                'description' => 'Accounts Receivable',
            ]);
        }

        //TODO Return a success response with the created Product
        return response()->json([
            'message' => 'Sale created successfully!',
            'data' => $sale,
        ], 201);
    }

    public function transliteratorCreate($saleVoucher, $transaction_type){
        //TODO Fetch the latest transaction to determine the last number
        $lastTransaction = Transactions::latest('id')->first();

        //TODO Generate the new transaction number
        $nextNumber = $lastTransaction ? $lastTransaction->id + 1 : 1;
        $transactionNumber = "Trx-" . $nextNumber;

        Transactions::create([
            'transaction_number' => $transactionNumber,
            'voucher_id' => $saleVoucher->id,
            'total_amount' => $saleVoucher->amount,
            'transaction_type' => $transaction_type,
            'transaction_date' => Carbon::now(),
            'description' => 'description',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $product)
    {
        //TODO Update the Product with validated data
        $product->update($request->validated());

        //TODO Return a success response
        return response()->json([
            'message' => 'Sale updated successfully!',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //TODO Delete the brand
        $sale->delete();

        //TODO Return a success response
        return response()->json([
            'message' => 'Sale deleted successfully!',
        ], 200);
    }
}
