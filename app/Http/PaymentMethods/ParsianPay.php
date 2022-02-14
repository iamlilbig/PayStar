<?php

namespace App\Http\PaymentMethods;
use App\Exceptions\v1\NotMatchCredentialException;
use Illuminate\Http\Request;
class ParsianPay implements PaymentContract
{
    public function pay(Request $request)
    {
        if($request->reason_description != null && $request->payment_number != null){
            return [
                'amount' => $request->amount,
                'description' => $request->description,
                'destination_firstname' => $request->destination_firstname,
                'destination_lastname' => $request->destination_lastname,
                'destination_number' => $request->destination_number,
                'second_password' => $request->second_password,
            ];
        }
        throw new NotMatchCredentialException();
    }
}
