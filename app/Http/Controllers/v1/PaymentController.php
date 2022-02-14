<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\v1\NotMatchCredentialException;
use App\Http\Controllers\Controller;
use App\Http\PaymentMethods\PaymentContract;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $credential = auth()->user()->payments;
        return response()->json(
            [
                'massage' => 'successes',
                'data' => new PaymentCollection($credential),
            ],
            200
        );
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

}
