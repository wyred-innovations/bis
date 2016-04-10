<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelationshipModel extends Model
{
    
	protected $table = 'ref_relationship';
   	protected $fillable = array('relationship_id', 'relationship');
    protected $primaryKey = 'relationship_id';
}
