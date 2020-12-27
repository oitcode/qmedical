<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientTestimonials extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_testimonials';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'client_testimonials_id';
}
