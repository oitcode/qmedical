<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTestType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_test_type';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'medical_test_type_id';

    protected $fillable = [
         'name', 'rate', 'comment',
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
        return $this->hasMany('App\MedicalTest', 'medical_test_type_id', 'medical_test_type_id');
    }
}
