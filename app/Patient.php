<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'name', 'sex', 'dob',
    ];


    /*-------------------------------------------------------------------------
     * Relationships
     *-------------------------------------------------------------------------
     *
     */


    /*
     * medical_test table
     *
     */
    public function medicalTests()
    {
        return $this->hasMany('App\MedicalTest', 'patient_id', 'patient_id');
    }
}
