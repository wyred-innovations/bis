<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LtapModel extends Model
{
    protected $table = 'dat_ltap';
   	protected $fillable = array('ltap_name','year', 'ltap_size',
   								'land_status_id','topography_id',
   								'ownership_id','person_id');
    protected $primaryKey = 'ltap_id';
}
