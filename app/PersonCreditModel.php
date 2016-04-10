<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonCreditModel extends Model
{
    protected $table = 'dat_person_credit';
   	protected $fillable = array('interest_id', 'person_id','parents','relative','traders','diocese',
   								'silingan','govt','po','fo','micro_finance');
    protected $primaryKey = 'person_credit_id';
}
