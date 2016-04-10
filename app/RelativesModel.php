<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelativesModel extends Model
{
    protected $table = 'ref_relatives';
   	protected $fillable = array('relatives_id', 'age','gender','relationship_id');
    protected $primaryKey = 'relatives_id';
}
