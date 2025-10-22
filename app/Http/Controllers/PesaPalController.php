<?php

namespace App\Http\Controllers;

use App\Models\PesaPal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Livewire\Products\Checkout as Products;
class PesaPalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function payupdate()
    {
        $pay = PesaPal::where([["tracking_id", request('OrderTrackingId')], ['merchant_reference', request('OrderMerchantReference')]])->first();

        $url = 'https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=' . $pay->tracking_id;
        $res = Http::withToken(Products::generate_token())->withHeaders(['Content-Type : application/json'])->get($url);
        $response = json_decode($res);
        if ($response->status == '200') {
            $pay->payment_account = $response->payment_account;
            $pay->amount = $response->amount;
            $pay->payment_method = $response->payment_method;
            $pay->confirmation_code = $response->confirmation_code;
            $pay->payment_status_description = $response->payment_status_description;
            $pay->update();
            return redirect('/dashboard')->with('success', 'Payment made successfully.');
        }
        return $response;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PesaPal $pesaPal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesaPal $pesaPal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesaPal $pesaPal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesaPal $pesaPal)
    {
        //
    }
    
}
