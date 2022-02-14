<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CredentialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'user' => new UserResource(auth()->user()),
            'id' => $this->id,
            'bank' => $this->bank,
            'shaba_id' => $this->shaba_id,
            'card_id' => $this->card_id,
            'account_id' => $this->account_id,
            'expire_time' => $this->expire_time,
        ];
    }
}
