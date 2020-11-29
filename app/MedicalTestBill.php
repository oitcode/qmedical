<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTestBill extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_test_bill';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'medical_test_bill_id';

    protected $fillable = [
         'amount', 'payment_status', 'medical_test_id', 'comment',
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
    public function medicalTests()
    {
        return $this->belongsTo('App\MedicalTest', 'medical_test_type_id', 'medical_test_type_id');
    }

    /*
     * medical_test_bill table.
     *
     */
    public function agentCommission()
    {
        return $this->hasOne('App\AgentCommission', 'medical_test_bill_id', 'medical_test_bill_id');
    }
}
