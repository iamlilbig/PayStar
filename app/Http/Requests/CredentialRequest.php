<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CredentialRequest extends FormRequest
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
            'bank' => ['required','regex:/^(Keshavarzi|Ayandeh|Parsian)$/'],
            'shaba_id' => ['required','regex:/^(?:IR)(?=.{24}$)[0-9]*$/','unique:credentials'],
            'card_id' => ['required','regex:/^\d{16}$/','unique:credentials'],
            'account_id' => ['required','regex:/^\d{13}$/','unique:credentials'],
            'expire_time' => ['required','regex:/^\d{2}\-\d{2}$/'],
        ];
    }
}
