<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agent';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'agent_id';

    protected $fillable = [
        'name', 'sex', 'contact_number', 'email', 'nationality', 'comment',
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
    public function MedicalTests()
    {
        return $this->hasMany('App\MedicalTest', 'agent_id', 'agent_id');
    }

    /*
     * agent_settlement table.
     *
     */
    public function agentSettlements()
    {
        return $this->hasMany('App\AgentSettlement', 'agent_id', 'agent_id');
    }

    /*
     * agent_transaction table.
     *
     */
    public function agentTransactions()
    {
        return $this->hasMany('App\AgentTransaction', 'agent_id', 'agent_id');
    }

    /*
     * agent_commission table.
     *
     */
    public function agentCommissions()
    {
        return $this->hasMany('App\AgentCommission', 'agent_id', 'agent_id');
    }

    /*
     * agent_loan table.
     *
     */
    public function agentLoans()
    {
        return $this->hasMany('App\AgentLoan', 'agent_id', 'agent_id');
    }

    /* Methods */

    public function getBalance()
    {
        $balance = 0;


        foreach ($this->agentTransactions as $agentTransaction) {
            if (strtolower($agentTransaction->direction) === 'in') {
                $balance += $agentTransaction->amount;
            } else if (strtolower($agentTransaction->direction) === 'out') {
                $balance -= $agentTransaction->amount;
            } else {
                // TODO: is this needed?
            }
        }

        return $balance;
    }
}
