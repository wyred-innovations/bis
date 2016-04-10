<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonIncomeModel extends Model
{
    protected $table = 'dat_person_income';
   	protected $fillable = array('income_item_id', 'person_id','income_expenses_id','tracking_id');
    protected $primaryKey = 'person_income_id';
}
