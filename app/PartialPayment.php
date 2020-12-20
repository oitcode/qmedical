<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartialPayment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partial_payment';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'partial_payment_id';

    protected $fillable = [
         'medical_test_id', 'amount', 'comment',
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
}
