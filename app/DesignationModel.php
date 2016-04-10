<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model
{
    protected $table = 'ref_designation';
    protected $primaryKey = 'des_id';
    protected $fillable = array('des_id', 'des_name');
}
