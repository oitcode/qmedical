<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentLoan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agent_loan';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'agent_loan_id';

    protected $fillable = [
         'agent_id', 'amount', 'payment_status',
    ];

    /*-------------------------------------------------------------------------
     * Relationships
     *-------------------------------------------------------------------------
     *
     */

    /*
     * agent table.
     *
     */
    public function agent()
    {
        return $this->belongsTo('App\Agent', 'agent_id', 'agent_id');
    }

    /*
     * payment table.
     *
     */
    public function payments()
    {
        return $this->hasMany('App\Payment', 'agent_loan_id', 'agent_loan_id');
    }

    /* methods */

    public function receivePayment($amount)
    {
        $topup = $amount;

        DB::beginTransaction();

        try {
            $pendingAmount = $this->getPendingAmount();

            $payment = new Payment;
            $payment->agent_loan_id = $this->agent_loan_id;

            if ($amount >= $pendingAmount) {
                $payment->amount = $pendingAmount;
                $this->payment_status = 'paid';
                $topup -= $pendingAmount;
            } else {
                $payment->amount = $amount;
                $this->payment_status = 'partially_paid';
                $topup = 0;
            }

            $payment->type = 'loan';
            $payment->save();

            $this->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return $topup;
    }

    public function getPendingAmount()
    {
        $pendingAmount = $this->amount;

        if ($this->payments) {
            foreach ($this->payments as $payment) {
                $pendingAmount -= $payment->amount;
            }
        }

        return $pendingAmount;
    }
}
