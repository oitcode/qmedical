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
}
