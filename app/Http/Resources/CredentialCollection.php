<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CredentialCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item){
            return [
                'id' => $item->id,
                'bank' => $item->bank,
                'shaba_id' => $item->shaba_id,
                'card_id' => $item->card_id,
                'account_id' => $item->account_id,
                'expire_time' => $item->expire_time,
            ];
        });
    }
}
