<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseItemModel extends Model
{
    protected $table = 'ref_expenses_item';
   	protected $fillable = array('expenses_item');
    protected $primaryKey = 'expenses_item_id';
}
