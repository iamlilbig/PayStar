<?php

namespace App\Http\PaymentMethods;
use App\Exceptions\v1\NotMatchCredentialException;
use Illuminate\Http\Request;
class KeshavarziPay implements PaymentContract
{
    public array $paymentInformation;

    public function __construct()
    {
        if(request()->deposit != null && request()->source_firstname != null && request()->source_lastname != null){
            $this->paymentInformation = [
                'credential_id' => request()->credential->id,
                'amount' => request()->amount,
                'description' => request()->description,
                'destination_firstname' => request()->destination_firstname,
                'destination_lastname' => request()->destination_lastname,
                'destination_number' => request()->destination_number,
                'deposit' => request()->deposit,
                'source_firstname' => request()->source_firstname,
                'source_lastname' => request()->source_lastname,
            ];
        }
        else {
            throw new NotMatchCredentialException();
        }
    }
}
