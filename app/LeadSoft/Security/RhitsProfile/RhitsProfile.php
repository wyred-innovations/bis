<?php namespace App\Rhits\Security\RhitsProfile;

use App\Http\Requests;
use App\Http\Controllers\controller_retrieve;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Request;
use Fpdf;
use basicListing;
use Log;

//custom
use rhitsHelpers;
use datatableFormat;
use rhitsValidation;
use Validator;
//=====data=====

use App\User;
use Auth;
use DB;
use Session;

  class RhitsProfile {

	public $select = false;
	public $insert = false;
	public $update = false;
	public $delete = false;

	public $systemSelect = false;
	public $systemInsert = false;
	public $systemUpdate = false;
	public $systemCreate = false;
	public $systemGrant  = false;
	
	public $serverSelect = false;
	public $serverInsert = false;
	public $serverUpdate = false;
	public $serverCreate = false;
	public $serverGrant  = false;
	
	
	public $username;
	public $password;
	public $tables       = "tbl_users";
	public $db           = "smi";
	public $error        = false;
	



	public function save(){
		
		try
		{
		    DB::statement('CREATE USER "'.$this->username.'"@"%" IDENTIFIED BY "'.$this->password.'"');
		}
		//catch specific exception....
		catch (\Illuminate\Database\QueryException $e)
		{
			$this->error = true;
		    Log::warning('User created duplicate or any mysql error on creating new mysql user.');
		}
		
	}

	public function grant(){

		//server
		$this->serverSelect($this->serverSelect);
		$this->serverUpdate($this->serverUpdate);
		$this->serverInsert($this->serverInsert);
		$this->serverCreate($this->serverCreate);
		$this->serverGrant($this->serverGrant);

		//system
		$this->systemSelect($this->systemSelect);
		$this->systemUpdate($this->systemUpdate);
		$this->systemInsert($this->systemInsert);
		$this->systemCreate($this->systemCreate);
		$this->systemGrant($this->systemGrant);
	}


	public function serverSelect($value){
		if($value){
			DB::statement('GRANT SELECT ON *.* TO "'.$this->username.'"@"%"');
		}else{
			DB::statement('REVOKE SELECT ON *.* FROM "'.$this->username.'"@"%"');
		}
	}
	public function serverUpdate($value){
		if($value){
			DB::statement('GRANT UPDATE ON *.* TO "'.$this->username.'"@"%"');
		}else{
			DB::statement('REVOKE UPDATE ON *.* FROM "'.$this->username.'"@"%"');
		}

	}
	public function serverInsert($value){
		if($value){
			DB::statement('GRANT INSERT ON *.* TO "'.$this->username.'"@"%"');
		}else{
			DB::statement('REVOKE INSERT ON *.* FROM "'.$this->username.'"@"%"');
		}
	}
	public function serverCreate($value){
		if($value){
			DB::statement('GRANT CREATE ON *.* TO "'.$this->username.'"@"%"');
		}else{
			DB::statement('REVOKE CREATE ON *.* FROM "'.$this->username.'"@"%"');
		}
	}
	public function serverGrant($value){
		if($value){
			DB::statement('GRANT GRANT OPTION ON *.* TO "'.$this->username.'"@"%"');
		}else{
			DB::statement('REVOKE GRANT OPTION ON *.* FROM "'.$this->username.'"@"%"');
		}
	}



	//

	public function systemSelect($value){
		if($value){
			DB::statement('GRANT SELECT ON '.$this->db.' .* TO '.$this->username.'@"%"');
		}else{
			DB::statement('REVOKE SELECT ON '.$this->db.' .* FROM '.$this->username.'@"%"');
		}

	}
	public function systemUpdate($value){
		if($value){
			DB::statement('GRANT UPDATE ON '.$this->db.'.* TO '.$this->username.'@"%"');
		}else{
			DB::statement('REVOKE UPDATE ON '.$this->db.'.* FROM '.$this->username.'@"%"');
		}
	}
	public function systemInsert($value){
		if($value){
			DB::statement('GRANT INSERT ON '.$this->db.'.* TO '.$this->username.'@"%"');
		}else{
			DB::statement('REVOKE INSERT ON '.$this->db.'.* FROM '.$this->username.'@"%"');
		}
	}
	public function systemCreate($value){
		if($value){
			DB::statement('GRANT CREATE ON '.$this->db.'.* TO '.$this->username.'@"%"');
		}else{
			DB::statement('REVOKE CREATE ON '.$this->db.'.* FROM '.$this->username.'@"%"');
		}
	}
	public function systemGrant($value){
		if($value){
			DB::statement('GRANT GRANT OPTION ON '.$this->db.'.* TO '.$this->username.'@"%"');
		}else{
			DB::statement('REVOKE GRANT OPTION ON '.$this->db.'.* FROM '.$this->username.'@"%"');
		}
	}

	

}

