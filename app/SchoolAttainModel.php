<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolAttainModel extends Model
{
    protected $table = 'ref_sch_attainment';
    protected $primaryKey = 'sch_id';
    protected $fillable = array('sch_id', 'attainment');
}
