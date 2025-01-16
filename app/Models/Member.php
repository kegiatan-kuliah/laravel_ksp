<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use CrudTrait;
    protected $table = 'members';

    protected $fillable = [
        'name','email','phone','address','date_of_joining'
    ];

    public function account(): HasOne
    {
        return $this->hasOne(SavingAccount::class, 'member_id');
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'member_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'member_id');
    }
}
