<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingAccount extends Model
{
    protected $table = 'saving_accounts';

    protected $fillable = [
        'member_id','account_number','balance','status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
