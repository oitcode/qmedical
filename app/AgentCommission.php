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
         'amount', 'payment_status', 'medical_test_bill_id', 'comment',
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
    public function medicalTestBill()
    {
        return $this->belongsTo('App\MedicalTestBill', 'medical_test_bill_id', 'medical_test_bill_id');
    }
}
