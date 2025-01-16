<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'member_id','transaction_type','transaction_date','amount'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
