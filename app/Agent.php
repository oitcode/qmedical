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
}
