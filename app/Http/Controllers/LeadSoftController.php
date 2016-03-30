<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Request;
use Fpdf;
use basicListing;
use LeadSoftModel;
use LeadAuth;
use ModuleRestriction;
use Storage;
use Response;
use datatableFormat;
use Validator;
use App\User;
use Auth;
use DB;
use Session;
use Hash;

class LeadSoftController extends Controller
{


	public function makeProfile()
	{	

		$return = new rrdReturn();

		$validator = Validator::make(
		    [
				'username'     => Request::input('email'),
				'password'     => Request::input('password')

		    ],
		    [
				'username'        => 'required|email|unique:tbl_users',
				'password'        => 'required|min:5'
		       
		    ]
		);

		if ($validator->fails())
		{
		    return $return->status(false)
	                      ->message($validator->errors()->all())
	                      ->show();
		}

		$person              = new LeadSoftModel('ref_person','person_id'); 
		$person->first_name  = Request::input('fname');
		$person->middle_name = Request::input('mname');
		$person->last_name   = Request::input('lname');
		$person->save();

		$personPrev = $person->max();


		$users            = new LeadSoftModel('tbl_users'); 
		$users->username  = Request::input('email');
		$users->password  = Hash::make(Request::input('password'));
		$users->person_id = $personPrev;
		$users->save();



		return $return->status(true)
	                      ->message("That is amazing! User has been Created!.")
	                      ->show();




	}

	public function createAccount(){

		return view('admin.security.account.accountRegistration');

	}

	public function forgotPassword(){

		return view('admin.security.login.forgotPassword');
	}

	public function requestVerificationCode(){

		return view('admin.security.login.verificationCode');
	}

	public function sendVerificationCode(){


		$user = db::table('tbl_users')
				->where('username',Request::input("email"))
				->first();

		$verification                    = new LeadSoftModel('dat_verification_request'); 
		$verification->user_id           = $user->user_id;
		$verification->verification_code = "";
		$verification->date_expire       = $personPrev;
		$verification->save();
	}


	


}
