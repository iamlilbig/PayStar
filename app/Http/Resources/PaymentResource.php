<?php

namespace App\Http\Resources;

use App\Models\Credential;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'credential' => new CredentialResource(Credential::find($this->credential_id)),
            'id' => $this->id,
            'status' => $this->status,
            'amount' => $this->amount,
            'description' => $this->description,
            'destination_firstname' => $this->destination_firstname,
            'destination_lastname' => $this->destination_lastname,
            'destination_number' => $this->destination_number,];
    }
}
