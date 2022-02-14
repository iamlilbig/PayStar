<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\PaymentMethods\PaymentContract;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request,PaymentContract $payment)
    {
        $payment = Payment::query()->create($payment->paymentInformation);
        $payment->update(['status',True]);

        return response()->json(
            [
                'massage' => 'successes',
                'data' => new PaymentResource($payment),
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
