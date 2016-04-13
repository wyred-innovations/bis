<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseTypeModel extends Model
{
    protected $table = 'ref_house_type';
   	protected $fillable = array('house_type');
    protected $primaryKey = 'house_type_id';
}
