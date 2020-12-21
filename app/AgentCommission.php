<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCommission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'agent_commission';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'agent_commission_id';

    protected $fillable = [
         'agent_id', 'medical_test_id', 'direction', 'amount', 'comment',
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
     * agent table.
     *
     */
    public function agent()
    {
        return $this->belongsTo('App\Agent', 'agent_id', 'agent_id');
    }
}
