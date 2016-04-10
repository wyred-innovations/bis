<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationModel extends Model
{
    protected $table = 'dat_verification_code';
    protected $primaryKey = 'ver_id';
    protected $fillable = array('user_id', 'verification_code','ver_id');
}
