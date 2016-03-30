<?php

/*
|--------------------------------------------------------------------------
| BIS
|--------------------------------------------------------------------------
|
|	BACKEND : Ralph Reigh Degoma
|	DATABASE: Aldwin Cafe Filoteo
| 	
*/




Route::get('/','MainloaderController@view');

Route::get('/bis/farmers/list','MainloaderController@getFarmers');
Route::get('/bis/farmers/farmers-registration','MainloaderController@getFarmersRegistration');
 

/*  S E C U R I T Y  */
		
		//AUTHENTICATION
Route::get('admin/security/login/Authentication','Auth\AuthController@Authenticate');
Route::post('admin/security/login/Authentication','Auth\AuthController@postLogin');
Route::get('admin/security/logout','Auth\AuthController@logout');
		

		//ACCOUNT MANAGEMENT
Route::get('/admin/security/create-account','LeadSoftController@createAccount');
Route::post('/admin/save/account','LeadSoftController@makeProfile');


		//PASSWORD
Route::get('/forgot-password','LeadSoftController@forgotPassword');
Route::get('/request-verification-code','LeadSoftController@requestVerificationCode');
Route::post('/send-verification-code','LeadSoftController@sendVerificationCode');




