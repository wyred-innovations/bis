<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnershipModel extends Model
{
    protected $table = 'ref_ownership';
   	protected $fillable = array('ownership');
    protected $primaryKey = 'ownership_id';
}
