<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonExpensesModel extends Model
{
    protected $table = 'dat_person_expenses';
   	protected $fillable = array('expense_item_id', 'person_id','income_expenses_id','tracking_id');
    protected $primaryKey = 'person_expenses_id';
}
