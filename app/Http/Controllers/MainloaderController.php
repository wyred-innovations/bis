<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MainloaderController extends Controller
{
    //

	public function __construct(){
		
		$this->middleware('auth');
	}

    public function view(){

    	return view('bis.main.index');
    }


    public function getFarmers(){
        return view('bis.farmers.list');
    }
    public function getFarmersRegistration(){
        return view('bis.farmers.farmers-registration');
    }
}
