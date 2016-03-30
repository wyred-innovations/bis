<?php namespace App\Rhits\Security\ModuleRestriction;

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

trait ModuleRestriction{
	
	protected $database = "smi_march";
	protected $tables; //object tables
	protected $roleId;
	protected $username;
	protected $sortedPermissionKeys = array();


	protected $tableWithPermission;

	public function setPermission($_roleId){

		$this->roleId = $_roleId;

		$this->setUsername();
		$this->setRegisteredTables();
		$this->revokeAllRegisteredTables();

		$this->grantUserPermissions();
	}

	public function grantUserPermissions(){

		$this->getTablePermissions();

		foreach($this->tableWithPermission as $_tablePermissions){

			$this->callMysqlGrantFunction($_tablePermissions);

		}
	}

	public function getTablePermissions(){

		$data = db::table('dat_modules')
					->where('tbl_permissions.role_id',$this->roleId)
					->leftjoin('tbl_permissions','tbl_permissions.m_id','=','dat_modules.m_id')
					->get();

		$this->tableWithPermission = $data;
	}

	public function revokeAllRegisteredTables(){

		foreach($this->tables as $_table){

			$this->callMysqlRevokeFunction($_table);

		}
	}

	public function setUsername(){

		$user = DB::table('roles')
				->where('role_id',$this->roleId)
				->first();

		$this->username = $user->role_name;
	}

	public function setRegisteredTables(){

		$_tables = DB::table('dat_modules')
				->where('role_id',$this->roleId)
				->leftjoin('tbl_permissions','tbl_permissions.m_id','=','dat_modules.m_id')
				->groupby('table')
				->get();

		$this->tables = $_tables;
	}

	public function callMysqlGrantFunction($_tablePermissions){

		if($_tablePermissions->select == "true"){
			$this->callMysqlGrantSelectFunction($_tablePermissions->table);
		}
		if($_tablePermissions->insert == "true"){
			$this->callMysqlGrantInsertFunction($_tablePermissions->table);
		}
		if($_tablePermissions->update == "true"){
			$this->callMysqlGrantUpdateFunction($_tablePermissions->table);
		}
	}

	public function callMysqlRevokeFunction($tableName){
		
		try{

			DB::statement('REVOKE SELECT ON `'.$this->database.'`.`'.$tableName->table.'` FROM `'.$this->username.'`@`%`');
		
		}catch(exception $e){

		}

		try{

			DB::statement('REVOKE INSERT ON `'.$this->database.'`.`'.$tableName->table.'` FROM `'.$this->username.'`@`%`');
		
		}catch(exception $e){
			
		}

		try{

			DB::statement('REVOKE UPDATE ON `'.$this->database.'`.`'.$tableName->table.'` FROM `'.$this->username.'`@`%`');
		
		}catch(exception $e){
			
		}
		
		

	}

	public function callMysqlGrantSelectFunction($tableName){
		DB::statement('GRANT SELECT ON "'.$this->database.".".$tableName.'" TO "'.$this->username.'"@"%"');
	}

	public function callMysqlGrantInsertFunction(){
		DB::statement('GRANT INSERT ON "'.$this->database.".".$tableName.'" TO "'.$this->username.'"@"%"');
	}

	public function callMysqlGrantUpdateFunction(){
		DB::statement('GRANT UPDATE ON "'.$this->database.".".$tableName.'" TO "'.$this->username.'"@"%"');
	}

	public function sortArrayPermissions(){

		$roleId = Request::all()["roleId"];
	    $mId = Request::all()["mId"];
	    $mIdAsKeys = array_flip($mId);;
	    $filtered =  Request::all();
	   
	    unset($filtered["roleModuleTables_length"]);
	    unset($filtered["roleId"]);
		unset($filtered["mId"]);

	    $grouper = 0;
	    $finalArray = array();

	    foreach($filtered as $key => $value){

	    	$key = explode("-",$key);
	    	$finalArray[$key[1]][$key[0]] = $value;

	    }
	    
	    $this->sortedPermissionKeys = $finalArray;

	}

}


?>