<?php namespace App\LeadSoft\LeadSoftModel;

use App\Http\Requests;
use App\Http\Controllers\controller_retrieve;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Request;
use Fpdf;
use basicListing;
use rhitsColumns;
use Config;
use Illuminate\Database\Eloquent\Model;

//=====data=====
use App\User;
use Auth;
use DB;
use Session;



class LeadSoftModel extends Model{

	public $timestamps = false;
	protected $table;
	protected $primaryKey;


	public function __construct($table,$id = "id"){

		$this->table = $table;
		$this->primaryKey = $id;

		Config::set('database.connections.' . 'flyConnection', array(
	        'driver'    => 'mysql',
	        'host'      => 'localhost',
	        'database'  => 'bis',
	        'username'  => 'root',
	        'password'  => 'looping123',
	        'charset'   => 'utf8',
	        'collation' => 'utf8_general_ci',
	        'prefix'    => '',
		));

		$this->setConnection('flyConnection');

	}

	public function max(){

        $data = DB::Connection('flyConnection')->table($this->table)
                ->max($this->primaryKey);
                
        return $data;

    }

    public function saveOrDeny(){//newly saved or max id

    	$data = DB::Connection('flyConnection')->table($this->table)
    			->where($this->attributes)
                ->first();

        if($data == null){

        	$this->save();
        	$result = $this->max();

        }else{

        	$result = $this->getSpecific();

        }

        return $result;
                
        
    }

    public function getId(){

    	$data = DB::Connection('flyConnection')->table($this->table)
    			->where($this->attributes)
                ->first();

        $result = $this->getSpecific();

        return $result;
    }

    public function getSpecific(){
    	$data = DB::Connection('flyConnection')->table($this->table)
    			->where($this->attributes)
                ->first();
                
        return $data;
    }

    public function exists($column){

    	$data = DB::Connection('flyConnection')->table($this->table)
    			->where($column,$this->{$column})
                ->get();
                
        if($data == null){
        	return false;
        }else{
        	return true;
        }
    }

    public function get(){

        $data = DB::Connection('flyConnection')->table($this->table)
                ->get();
                
        return $data;

    }

    

}
