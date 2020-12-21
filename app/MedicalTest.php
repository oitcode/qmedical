<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_test';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'medical_test_id';

    // protected $fillable = [
    //      'date', 'name', 'amount', 'comment',
    // ];

    /*-------------------------------------------------------------------------
     * Relationships
     *-------------------------------------------------------------------------
     *
     */

    /*
     * medical_test_type table.
     *
     */
    public function medicalTestType()
    {
        return $this->belongsTo('App\MedicalTestType', 'medical_test_type_id', 'medical_test_type_id');
    }

    /*
     * patient table.
     *
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id', 'patient_id');
    }

    /*
     * agent table.
     *
     */
    public function agent()
    {
        return $this->belongsTo('App\Agent', 'agent_id', 'agent_id');
    }

    /*
     * medical_test_type table.
     *
     */
    public function medicalTestBill()
    {
        return $this->hasOne('App\MedicalTestBill', 'medical_test_id', 'medical_test_id');
    }

    /*
     * medical_test_type table.
     *
     */
    public function agentSettlement()
    {
        return $this->hasOne('App\AgentSettlement', 'medical_test_id', 'medical_test_id');
    }

    public function agentTransaction()
    {
        return $this->hasOne('App\AgentTransaction', 'medical_test_id', 'medical_test_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'medical_test_id', 'medical_test_id');
    }

    public function agentCommission()
    {
        return $this->hasOne('App\AgentCommission', 'medical_test_id', 'medical_test_id');
    }
}
