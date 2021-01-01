<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'payment_id';

    protected $fillable = [
         'medical_test_id', 'amount', 'type', 'comment',
    ];

    /*-------------------------------------------------------------------------
     * Relationships
     *-------------------------------------------------------------------------
     *
     */

    /*
     * medical_test table.
     *
     */
    public function medicalTest()
    {
        return $this->belongsTo('App\MedicalTest', 'medical_test_id', 'medical_test_id');
    }

    /*
     * agent_loan table.
     *
     */
    public function agentLoan()
    {
        return $this->belongsTo('App\AgentLoan', 'agent_loan_id', 'agent_loan_id');
    }

    public function triggerPayment()
    {
        return $this->belongsTo('App\Payment', 'tg_payment_id', 'payment_id');
    }

    public function triggeredPayments()
    {
        return $this->hasMany('App\Payment', 'tg_payment_id', 'payment_id');
    }

    public function deleteAndUpdatePaymentStatus()
    {
        if ($this->medicalTest) {
            $medicalTest = $this->medicalTest;

            if ($medicalTest->payments && count($medicalTest->payments) === 1) {
                $medicalTest->payment_status = 'pending';
            } else if ($medicalTest->payments && count($medicalTest->payments) > 1) {
                $medicalTest->payment_status = 'partially_paid';
            } else {
                // TODO: Is this needed?
            }

            $medicalTest->save();
        }

        if ($this->agentLoan) {
            $agentLoan = $this->agentLoan;

            if ($agentLoan->payments && count($agentLoan->payments) === 1) {
                $agentLoan->payment_status = 'pending';
            } else if ($agentLoan->payments && count($agentLoan->payments) > 1) {
                $agentLoan->payment_status = 'partially_paid';
            } else {
                // TODO: Is this needed?
            }

            $agentLoan->save();
        }

        $this->delete();
    }
}
