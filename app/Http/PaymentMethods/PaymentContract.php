<?php

namespace App\Http\PaymentMethods;

use Illuminate\Http\Request;

interface PaymentContract
{
    public function pay(Request $request);
}
