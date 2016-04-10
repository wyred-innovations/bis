<?php namespace App\LeadSoft\Security\LeadAuth;

use LeadSoftModel;
use App\Http\Requests;
use App\Http\Controllers\controller_retrieve;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Request;
use Fpdf;
use basicListing;
use ModuleRestriction;

use rhitsHelpers;
use datatableFormat;
use rhitsValidation;
use Validator;
//=====data=====

use App\User;
use Auth;
use DB;
use Session;


trait LeadAuth {
	

	public function postLogin(){


		$validator = Validator::make(
		    [
		        'username' => Request::input('email'),
		        'password' => Request::input('password')
		    ],
		    [
		        'username' => 'required|email',
		        'password' => 'required'
		    ]
		);

		if ($validator->fails())
		{	

			$messages = $validator->errors()->all();
		   	return $this->errorLoginRedirect($messages);
		}



		return $this->checkUserExists();
	}



	public function errorLoginRedirect($messages){

		
		return view('admin/security/login/Authentication')
						->with('messages', $messages);
	}

	public function checkUserExists(){

		//User::create(['User' => Request::input('username'), 'pass' => bcrypt(Request::input('password'))]);
		if (Auth::attempt(array('username' => Request::input('email'), 'password' => Request::input('password'))))
        {
            return redirect()->intended($this->redirectPath());
        }
        	
    	$messages = "Credentials didnt matched!";
    	return $this->errorLoginRedirect($messages);

	}

	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}

	public function redirectPathCorrectLogin(){

		return redirect('/');
    }

    public function logout(){

    	Auth::logout();

    	return redirect('admin/security/login/Authentication');
    }

    public function Authenticate(){

    	if (Auth::check())
		{
		    return redirect()->intended($this->redirectPath());// The user is logged in...
		}
    	
    	return view('admin/security/login/Authentication');
    }
}