<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationModel extends Model
{
    protected $table = 'ref_organization';
   	protected $fillable = array('organization_id', 'organization__name');
    protected $primaryKey = 'organization_id';
}
