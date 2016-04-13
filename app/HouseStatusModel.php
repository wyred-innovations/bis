<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseStatusModel extends Model
{
    protected $table = 'ref_house_status';
   	protected $fillable = array('house_status');
    protected $primaryKey = 'house_status_id';
}
