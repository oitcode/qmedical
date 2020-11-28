<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expense';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'expense_id';

    protected $fillable = [
         'date', 'name', 'amount', 'comment',
    ];
}
