<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'user_id',
        'shaba_id',
        'card_id',
        'account_id',
        'expire_time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
