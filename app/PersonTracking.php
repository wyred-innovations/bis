<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonTracking extends Model
{
    protected $table = 'dat_tracking';
   	protected $fillable = array('year');
    protected $primaryKey = 'tracking_id';
}
