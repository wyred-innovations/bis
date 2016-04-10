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

//farmer
Route::get('/bis/farmers/list','FarmerController@getFarmers');
Route::get('/bis/farmers/farmers-registration','FarmerController@getFarmersRegistration');
Route::get('/bis/farmers-tracking-years/{id}','FarmerController@getFarmersTrackingYears');
Route::get('/bis/farmer/{id}','FarmerController@editFarmer');
Route::post('/bis/farmer-registration','FarmerController@storeNewFarmer');
Route::get('/retrieve/farmerList','FarmerController@getFarmersList');
Route::post('/bis/farmer-update','FarmerController@updateFarmerInfo');
Route::get('/bis/farmers/new-tracking/{id}','FarmerController@newTracking');


//tracking years
Route::get('/retrieve/trackingYears/{id}','FarmerController@trackingYearsPerson');
Route::post('/bis/save-new-tracking','FarmerController@saveNewTracking');
Route::get('/retrieve/trackingYears/{id}/{year}','FarmerController@editTrackingYear');
Route::post('/bis/update-new-tracking','FarmerController@updateNewTracking');


// wyred - update
Route::post('/bis/expenses-item/update/expenses_item','FarmerController@expensesItemUpdate');
Route::post('/bis/income-item/update/income_item','FarmerController@incomeItemUpdate');


//autosuggests
Route::get('/bis/getreligion','AutoSuggestController@getreligion');
Route::get('/bis/getTribe','AutoSuggestController@getTribe');
Route::get('/bis/getOrganization','AutoSuggestController@getOrganization');
Route::get('/bis/getCivilStatus','AutoSuggestController@getCivilStatus');
Route::get('/bis/getSchoolAttainment','AutoSuggestController@getSchoolAttainment');
Route::get('/bis/getDesignation','AutoSuggestController@getDesignation');
Route::get('/bis/getRelationship','AutoSuggestController@getRelationship');
Route::get('/bis/getHouseStatus','AutoSuggestController@getHouseStatus');



//reports
Route::get('/bis/farmers/reports','ReportController@getFarmersReports');
Route::get('/test_pdf','ReportController@test_pdf');
Route::post('/bis/bargraph-report','ReportController@bargraphGuiReport');



















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
Route::post('/password-reset','LeadSoftController@passwordReset');


//facebook
Route::get('auth/facebook', 'Auth\AuthFacebookController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthFacebookController@handleProviderCallback');