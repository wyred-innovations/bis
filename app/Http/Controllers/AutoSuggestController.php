<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use App\ReligionModel;
use App\TribeModel;
use App\OrganizationModel;
use App\CivilStatusModel;
use App\SchoolAttainModel;
use App\DesignationModel;
use App\RelationshipModel;
use App\HouseStatusModel;

class AutoSuggestController extends Controller
{
    public function getreligion(){

    	$data  = ReligionModel::where('religion_name', 'like', '%'.Request::input('inputVal').'%')
    		->take(5)
    		->orderby('religion_name','asc')
    		->get();

    	return $data;
    }

    public function getTribe(){

    	$data  = TribeModel::where('tribe_name', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('tribe_name','asc')
	    	->get();

    	return $data;

    }

    public function getOrganization(){

    	$data  = OrganizationModel::where('organization_name', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('organization_name','asc')
	    	->get();

    	return $data;

    }

    public function getCivilStatus(){

    	$data  = CivilStatusModel::where('civil_status', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('civil_status','asc')
	    	->get();

    	return $data;

    }

    public function getSchoolAttainment(){

    	$data  = SchoolAttainModel::where('attainment', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('attainment','asc')
	    	->get();

    	return $data;

    }

    public function getDesignation(){

    	$data  = DesignationModel::where('des_name', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('des_name','asc')
	    	->get();

    	return $data;

    }

    public function getRelationship(){

    	$data  = RelationshipModel::where('relationship', 'like', '%'.Request::input('inputVal').'%')
	    	->take(5)
	    	->orderby('relationship','asc')
	    	->get();

    	return $data;

    }

    public function getHouseStatus(){

        $data  = HouseStatusModel::where('house_status', 'like', '%'.Request::input('inputVal').'%')
            ->take(5)
            ->orderby('house_status','asc')
            ->get();

        return $data;

    }



    
}
