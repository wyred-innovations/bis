<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\controller_retrieve;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


//=====data=====
use App\User;
use Auth;
use DB;
use Session;
use Mail;

class MainloaderController extends Controller
{
    //

  	public function __construct(){
  		
  		$this->middleware('auth');
  	}

    public function view(){

    	return view('bis.main.index');
    }
    

    
    public function home(){
       return view('bis.farmers.home');
    }
}
