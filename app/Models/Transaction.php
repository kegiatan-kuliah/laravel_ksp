<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use CrudTrait;
    protected $table = 'transactions';

    protected $fillable = [
        'member_id','transaction_type','transaction_date','amount'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
