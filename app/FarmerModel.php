<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerModel extends Model
{

    protected $table = 'ref_person';
    protected $primaryKey = 'person_id';
    protected $fillable = array(
    							'first_name', 
    							'middle_name',
    							'last_name',
    							'age',
    							'gender',
    							'religion_id',
    							'tribe_id',
    							'civil_id',
    							'start_of_crop',
    							'address',
    							'sch_id');

   

}
