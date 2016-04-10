<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReligionModel extends Model
{
    protected $table = 'ref_religion';
   	protected $fillable = array('religion_id', 'religion_name');
    protected $primaryKey = 'religion_id';
}
