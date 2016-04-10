<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TanumKahayupanModel extends Model
{
    protected $table = 'dat_tk';
   	protected $fillable = array('tk_name', 'type_id',
   								'status_id','technology_apply_id',
   								'input_used');
    protected $primaryKey = 'tk_id';
}
