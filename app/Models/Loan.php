<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';

    protected $fillable = [
        'member_id','application_date','due_date','loan_amount','interest_rate','loan_term_months','monthly_installment','status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class, 'loan_id');
    }
}