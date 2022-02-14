<?php

namespace App\Http\Requests;

use App\Models\Credential;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'credential'=> ['required'],
            'amount' => ['required'],
            'description' => ['required'],
            'destination_firstname' => ['required'],
            'destination_lastname' => ['required'],
            'destination_number' => ['required'],
            'deposit' =>[],
            'source_firstname' => [],
            'source_lastname' => [],
            'payment_number' => [],
            'reason_description' => [],
            'second_password' => [],
        ];
    }
}
