<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TribeModel extends Model
{
   	protected $table = 'ref_tribe';
   	protected $fillable = array('criteria_id', 'tribe_name');
    protected $primaryKey = 'tribe_id';
}
