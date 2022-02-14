<?php

namespace App\Http\PaymentMethods;
use App\Exceptions\v1\NotMatchCredentialException;
use Illuminate\Http\Request;
class ParsianPay implements PaymentContract
{
    public array $paymentInformation;

    public function __construct()
    {
        if(request()->second_password != null){
            $this->paymentInformation = [
                'credential_id' => request()->credential->id,
                'amount' => request()->amount,
                'description' => request()->description,
                'destination_firstname' => request()->destination_firstname,
                'destination_lastname' => request()->destination_lastname,
                'destination_number' => request()->destination_number,
                'second_password' => request()->second_password,
            ];
        }
        else {
            throw new NotMatchCredentialException();
        }
    }
}
