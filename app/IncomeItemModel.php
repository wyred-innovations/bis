<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeItemModel extends Model
{
    protected $table = 'ref_income_item';
   	protected $fillable = array('income_item_id', 'income_item');
    protected $primaryKey = 'income_item_id';
}
