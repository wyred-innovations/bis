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
use Mail;
use App\VerificationModel;

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

	

	public function passwordReset(){


		$return = new rrdReturn();

		$date = date("Y/m/d");
		$thisDate = str_replace('/', '-', $date);
		$user = db::table('tbl_users')
				->where('username',Request::input("email"))
				->first();

		if(count($user) > 0){


			$verifyVCode = db::table('dat_verification_code')
				->where('verification_code',Request::input("verification_code"))
				->get();

			

			if(count($verifyVCode) == 0){

				return $return->status(false)
		                      ->message("Verification Code is invalid.Try again.")
		                      ->show();
			}else{

				$codeExpires = db::table('dat_verification_code')
				->where('verification_code',Request::input("verification_code"))			
				->where('date_expire','=',$thisDate)	
				->get();

				if(count($codeExpires) == 0){

					return $return->status(false)
			                      ->message("Verification Code expired. Please request another one.")
			                      ->show();
				}
			}

			$userVerification = db::table('tbl_users')
				->where('user_id',$user->user_id)
				->update([
							'password' => bcrypt(Request::input("new_password"))
						 ]);
		}else{

			return $return->status(false)
		                      ->message("Email is not registered. Try again.")
		                      ->show();
		}

		$deleteVerificationCode = db::table('dat_verification_code')
				->where('user_id',$user->user_id)
				->update([
							'verification_code' => ''
						 ]);

		return $return->status(true)
		                      ->message("Password has been updated!")
		                      ->show();

	}

	public function sendVerificationCode(){

		$return = new rrdReturn();

		$user = db::table('tbl_users')
				->where('username',Request::input("email"))
				->first();
		do {

			$verificationCode = str_random(20);

			$verify = db::table('dat_verification_code')
				->where('verification_code',$verificationCode)
				->get();

		} while (count($verify) > 0);


		if(count($user) == 0){

			return $return->status(false)
		                      ->message("Email is not a registered. Try again.")
		                      ->show();
		} 

		Mail::send('admin.mail.verificationCode', ['vcode' => $verificationCode], function($message)
        {
            $message->to(Request::input("email"), 'SMI')->subject('Verification Code');
        });


		$date = date("Y/m/d");
		$expire = str_replace('-', '/', $date);




		$userVerification = db::table('dat_verification_code')
				->where('user_id',$user->user_id)
				->get();

		if(count($userVerification) > 0){

			$userVerification = db::table('dat_verification_code')
				->where('user_id',$user->user_id)
				->update(['verification_code' => $verificationCode ,
						  'date_expire'		 => $expire
						 ]);
		}else{

			$verification                    = new VerificationModel; 
			$verification->user_id           = $user->user_id;
			$verification->verification_code = $verificationCode;
			$verification->date_expire       = $expire;
			$verification->save();
		}

		

		return $return->status(true)
		                      ->message("Verification Code has been sent!")
		                      ->show();

	}

	


}
