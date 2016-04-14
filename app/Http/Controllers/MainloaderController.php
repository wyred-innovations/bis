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

      $members = db::table('ref_person')->get();
      $orgs = db::table('ref_organization')->get();


      $graph = db::table('tblviewhomegraph')->where('organization_name','<>',"")->get();


      $orgHolder = "";
      $orgArray = [];
      $finalOrgMembers = [];

      foreach ($graph as $key => $value) {
            
            if($orgHolder == ""){
                $orgHolder =  $value->organization_name;
                $orgArray[] = $value->organization_name;
            }
            if($orgHolder != $value->organization_name){

                $orgHolder =  $value->organization_name;
                $orgArray[] = $value->organization_name;
            }
        }


      foreach($orgArray as $orgArrayValue){

          foreach($graph as $dataValue){

                  if($orgArrayValue == $dataValue->organization_name){

                      $finalOrgMembers[$orgArrayValue][] = $dataValue;
                  }
              }
      }


      return view('bis.farmers.home')
            ->with('members', $members)
            ->with('finalOrgMembers', $finalOrgMembers)
            ->with('orgs', $orgs);
    }

    public function toAddFarmer(){
      return view('bis.support.how-to-add-new-farmer');
    }

    public function toAddTrackRecords(){
      return view('bis.support.how-to-add-new-track-records');
    }
}
