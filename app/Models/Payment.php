<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable=[
        'credential_id',
        'status',
        'amount',
        'description',
        'destination_firstname',
        'destination_lastname',
        'destination_number',
        'payment_number',
        'reason_description',
        'deposit',
        'source_firstname',
        'source_lastname',
        'second_password',
    ];

    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }
}
