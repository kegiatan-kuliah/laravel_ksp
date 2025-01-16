<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class SavingAccount extends Model
{
    use CrudTrait;
    protected $table = 'saving_accounts';

    protected $fillable = [
        'member_id','account_number','balance','status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function getMemberName()
    {
        return $this->member->name;
    }
}
