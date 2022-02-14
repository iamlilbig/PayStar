<?php

namespace App\Http\PaymentMethods;
use App\Exceptions\v1\NotMatchCredentialException;
use Illuminate\Http\Request;
class AyandehPay implements PaymentContract
{
    public array $paymentInformation;

    public function __construct()
    {
        if(request()->reason_description != null && request()->payment_number != null){
            $this->paymentInformation = [
                'credential_id' => request()->credential->id,
                'amount' => request()->amount,
                'description' => request()->description,
                'destination_firstname' => request()->destination_firstname,
                'destination_lastname' => request()->destination_lastname,
                'destination_number' => request()->destination_number,
                'payment_number' => request()->payment_number,
                'reason_description' => request()->reason_description,
            ];
        }
        else {
            throw new NotMatchCredentialException();
        }
    }
}
