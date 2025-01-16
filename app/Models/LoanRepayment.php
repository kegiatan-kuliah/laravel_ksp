<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    protected $table = 'loan_repayments';

    protected $fillable = [
        'payment_date','amount','penalty_amount','loan_id'
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
