<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use DB;
//models
use App\FarmerModel;
use App\TribeModel;
use App\CivilStatusModel;
use App\SchoolAttainModel;
use App\OrganizationModel;
use App\ReligionModel;
use App\RelativesModel;
use App\RelationshipModel;
use App\DesignationModel;
use App\PersonIncomeModel;
use App\IncomeItemModel;
use App\PersonCreditModel;
use App\LtapModel;
use App\TanumKahayupanModel;
use App\ExpenseItemModel;
use App\PersonExpensesModel;
use App\OwnershipModel;
use App\PersonTracking;

use DatatableFormat;

class FarmerController extends Controller
{
    public function storeNewFarmer(){

        $return = new rrdReturn();


        $tribe             = TribeModel::firstOrNew(['tribe_name' => Request::input('tribe_name')]);     
    		$tribe->tribe_name = Request::input('tribe_name');
    		$tribe->save();

    		$tribeData = TribeModel::where('tribe_name', '=', Request::input('tribe_name'))->first();


    		$civilStatus               = CivilStatusModel::firstOrNew(['civil_status' => Request::input('civil_status')]);     
    		$civilStatus->civil_status = Request::input('civil_status');
    		$civilStatus->save();

    		$civilData = CivilStatusModel::where('civil_status', '=', Request::input('civil_status'))->first();


    		$School               = SchoolAttainModel::firstOrNew(['attainment' => Request::input('sch_attainment')]);     
    		$School->attainment = Request::input('sch_attainment');
    		$School->save();

    		$SchoolData = SchoolAttainModel::where('attainment', '=', Request::input('sch_attainment'))->first();


    		$organization               = OrganizationModel::firstOrNew(['organization_name' => Request::input('organization')]);     
    		$organization->organization_name = Request::input('organization');
    		$organization->save();

    		$organizationData = OrganizationModel::where('organization_name', '=', Request::input('organization'))->first();


    		$religion               = ReligionModel::firstOrNew(['religion_name' => Request::input('religion_name')]);     
    		$religion->religion_name = Request::input('religion_name');
    		$religion->save();

    		$religionData = ReligionModel::where('religion_name', '=', Request::input('religion_name'))->first();

        $farmer                  = new FarmerModel;
        $farmer->first_name      = Request::input('first_name');
        $farmer->middle_name     = Request::input('middle_name');
        $farmer->last_name       = Request::input('last_name');
        $farmer->age             = Request::input('age');
        $farmer->gender          = Request::input('gender');
        $farmer->organization_id = $organizationData->organization_id;
        $farmer->religion_id     = $religionData->religion_id;
        $farmer->tribe_id        = $tribeData->tribe_id;
        $farmer->civil_id        = $civilData->civil_id;
        $farmer->start_of_crop   = Request::input('start_crop');
        $farmer->address         = $SchoolData->sch_id;
        $farmer->sch_id          = Request::input('sch_attainment');
        $farmer->save();

    		$personData = DB::table('ref_person')->max('person_id');

    		for($i=0; $i <= count(Request::input('h_age')) -1 ; $i++){

    			$relationship               = RelationshipModel::firstOrNew(['relationship' => Request::input('relationship_name')[$i]]);     
    			$relationship->relationship = Request::input('relationship_name')[$i];
    			$relationship->save();

    			$relationshipData = RelationshipModel::where('relationship', '=', Request::input('relationship_name')[$i])->first();

    			$relatives                  = new RelativesModel;
    			$relatives->person_id       = $personData;
    			$relatives->age             = Request::input('h_age')[$i];
    			$relatives->gender          = Request::input('h_gender')[$i];
    			$relatives->relationship_id = $relationshipData->relationship_id;
    			$relatives->save(); 
    		}

    		return $return->status(true)
                          ->message("That is amazing! it has been saved!.")
                          ->show();

    }

    public function getFarmersList(){

    	$data = db::table('tblviewfarmerinfo')->get();

    	$datatableFormat = new DatatableFormat();
        return $datatableFormat->format($data);


    }

    public function incomeItemUpdate(){

        $return = new rrdReturn();

        if(Request::input('value') == ""){
            return $return->status(false)
                          ->message("Blank item will not be accepted or updated.")
                          ->show();
        }

        $IncomeItemModel                  = IncomeItemModel::where('income_item_id', '=', Request::input('id'));
        $IncomeItemModel->update([

              'income_item'      => Request::input('value'),

        ]);

        return $return->status(true)
                          ->message("Awesome! it has been updated!.")
                          ->show();
    }

    public function expensesItemUpdate(){

        $return = new rrdReturn();

        if(Request::input('value') == ""){
            return $return->status(false)
                          ->message("Blank item will not be accepted or updated.")
                          ->show();
        }

        $ExpenseItemModel                  = ExpenseItemModel::where('expenses_item_id', '=', Request::input('id'));
        $ExpenseItemModel->update([

              'expenses_item'      => Request::input('value'),

        ]);

        return $return->status(true)
                          ->message("Awesome! it has been updated!.")
                          ->show();

    }

    public function getFarmers(){
        return view('bis.farmers.list');
    }
    public function getFarmersRegistration(){

      $housestatus = DB::table('tblviewhousestatus')->get();
      $housetype = DB::table('tblviewhousetype')->get();

      return view('bis.farmers.farmers-registration')
          ->with('housestatus',$housestatus)
          ->with('housetype',$housetype);
    }

    public function incomeAndExpences(){

    }

    public function getFarmersTrackingYears($id){

        $income = DB::table('tblviewincome')->get();
        $expenses = DB::table('tblviewexpenses')->get();
        $incomerates = DB::table('tblviewincomerates')->get();
        $housestatus = DB::table('tblviewhousestatus')->get();
        $housetype = DB::table('tblviewhousetype')->get();
        $interest = DB::table('tblviewinterest')->get();
        $landstatus = DB::table('tblviewlandstatus')->get();
        $topography = DB::table('tblviewtopography')->get();

        $user = db::table('ref_person')->where('person_id',$id)->first();

        return view('bis.farmers.farmers-tracking-years')
              ->with('user',$user)
              ->with('income',$income)
              ->with('expenses',$expenses)
              ->with('incomerates',$incomerates)
              ->with('housestatus',$housestatus)
              ->with('housetype',$housetype)
              ->with('interest',$interest)
              ->with('landstatus',$landstatus)
              ->with('topography',$topography);
    }

    public function newTracking($id){

        $income = DB::table('tblviewincome')->get();
        $expenses = DB::table('tblviewexpenses')->get();
        $incomerates = DB::table('tblviewincomerates')->get();
        $housestatus = DB::table('tblviewhousestatus')->get();
        $housetype = DB::table('tblviewhousetype')->get();
        $interest = DB::table('tblviewinterest')->get();
        $landstatus = DB::table('tblviewlandstatus')->get();
        $topography = DB::table('tblviewtopography')->get();

        $agri_type = DB::table('ref_agri_type')->get();
        $agri_status = DB::table('ref_status')->get();
        $techApply = DB::table('ref_technology_apply')->get();

        $user = db::table('ref_person')->where('person_id',$id)->first();

        return view('bis.farmers.farmersNewTracking')
              ->with('user',$user)
              ->with('income',$income)
              ->with('agri_type',$agri_type)
              ->with('agri_status',$agri_status)
              ->with('techApply',$techApply)
              ->with('expenses',$expenses)
              ->with('incomerates',$incomerates)
              ->with('housestatus',$housestatus)
              ->with('housetype',$housetype)
              ->with('interest',$interest)
              ->with('landstatus',$landstatus)
              ->with('topography',$topography);
    }



    public function saveNewTracking(){

      $return = new rrdReturn();
      

      $yearExists = db::table('dat_tracking')
        ->where('year',Request::input('year'))
        ->where('person_id',Request::input('person_id'))
        ->get();

      

      if(count($yearExists) > 0){

          $person = db::table('ref_person')->where('person_id',Request::input('person_id'))->first();
          return $return->status(false)
                          ->message("Year already tracked for ".$person->last_name.", ".$person->first_name. " " .$person->middle_name.".")
                          ->show();
      }

      $PersonTracking            = new PersonTracking;
      $PersonTracking->year      = Request::input('year');
      $PersonTracking->person_id = Request::input('person_id');
      $PersonTracking->save();

      $PersonTrackingData = PersonTracking::where('year', '=', Request::input('year'))
                                            ->where('person_id',Request::input('person_id'))
                                            ->first();


      for($i = 0; $i <= count(Request::input('income_item')) - 1; $i++){  

          if(Request::input('income_item')[$i] != "" and Request::input('incomerates')[$i] != "") {

            $IncomeItemModel             = IncomeItemModel::firstOrNew(['income_item' => Request::input('income_item')[$i]]);     
            $IncomeItemModel->income_item = Request::input('income_item')[$i];
            $IncomeItemModel->save();
            $IncomeItemData = IncomeItemModel::where('income_item', '=', Request::input('income_item')[$i])->first();

            $PersonIncomeModel                     = new PersonIncomeModel;
            $PersonIncomeModel->income_item_id     = $IncomeItemData->income_item_id;
            $PersonIncomeModel->tracking_id        = $PersonTrackingData->tracking_id;
            $PersonIncomeModel->income_expenses_id = Request::input('incomerates')[$i];
            $PersonIncomeModel->save();
          } 

          if(Request::input('expenses_item')[$i] != "" and Request::input('expenses_rates')[$i] != "") {

            $ExpenseItemModel             = ExpenseItemModel::firstOrNew(['expenses_item' => Request::input('expenses_item')[$i]]);     
            $ExpenseItemModel->expenses_item = Request::input('expenses_item')[$i];
            $ExpenseItemModel->save();
            $ExpenseItemModelData = ExpenseItemModel::where('expenses_item', '=', Request::input('expenses_item')[$i])->first();


            $PersonExpensesModel                     = new PersonExpensesModel;
            $PersonExpensesModel->expenses_item_id     = $ExpenseItemModelData->expenses_item_id;
            $PersonExpensesModel->income_expenses_id = Request::input('expenses_rates')[$i];
            $PersonExpensesModel->tracking_id        = $PersonTrackingData->tracking_id;
            $PersonExpensesModel->save();
          }
      }


      foreach(Request::input('srcCredit') as $interest_id){


            $PersonCreditModel                = new PersonCreditModel;
            $PersonCreditModel->interest_id   = $interest_id;
            $PersonCreditModel->parents       = $this->torf(Request::input('parents'.$interest_id));
            $PersonCreditModel->relative      = $this->torf(Request::input('relative'.$interest_id));
            $PersonCreditModel->traders       = $this->torf(Request::input('traders'.$interest_id));
            $PersonCreditModel->diocese       = $this->torf(Request::input('diocese'.$interest_id));
            $PersonCreditModel->silingan      = $this->torf(Request::input('silingan'.$interest_id));
            $PersonCreditModel->govt          = $this->torf(Request::input('govt'.$interest_id));
            $PersonCreditModel->po            = $this->torf(Request::input('po'.$interest_id));
            $PersonCreditModel->fo            = $this->torf(Request::input('fo'.$interest_id));
            $PersonCreditModel->micro_finance = $this->torf(Request::input('micro_finance'.$interest_id));    
            $PersonCreditModel->tracking_id   = $PersonTrackingData->tracking_id;
            $PersonCreditModel->save();
          
      }


      for($i = 0; $i <= count(Request::input('land_name')) - 1; $i++){


          $OwnershipModel            = OwnershipModel::firstOrNew(['ownership' => Request::input('ownership')[$i]]);     
          $OwnershipModel->ownership = Request::input('ownership')[$i];
          $OwnershipModel->save();
          $OwnershipModelData        = OwnershipModel::where('ownership', '=', Request::input('ownership')[$i])->first();
          
          $LtapModel                 = new LtapModel;
          $LtapModel->ltap_name      = Request::input('land_name')[$i];
          $LtapModel->ltap_size      = Request::input('land_size')[$i];
          $LtapModel->land_status_id = Request::input('landstatus')[$i];
          $LtapModel->topography_id  = Request::input('topog_size')[$i];
          $LtapModel->ownership_id   = $OwnershipModelData->ownership_id;
          $LtapModel->tracking_id    = $PersonTrackingData->tracking_id;
          $LtapModel->save();
         
      }


      for($i = 0; $i <= count(Request::input('tk_name')) - 1; $i++){

          $TanumKahayupanModel                      = new TanumKahayupanModel;
          $TanumKahayupanModel->tk_name             = Request::input('tk_name')[$i];
          $TanumKahayupanModel->type_id             = Request::input('agri_type')[$i];
          $TanumKahayupanModel->status_id           = Request::input('agri_status')[$i];
          $TanumKahayupanModel->technology_apply_id = Request::input('techApply')[$i];
          $TanumKahayupanModel->input_used          = Request::input('input_used')[$i];
          $TanumKahayupanModel->tracking_id         = $PersonTrackingData->tracking_id;
          $TanumKahayupanModel->save();
         
      }

      


      
      return $return->status(true)
                          ->message("New tracking has been saved!.")
                          ->show();

    }







    public function updateNewTracking(){

        $return = new rrdReturn();
        

        $yearExists = db::table('dat_tracking')
        ->where('year',Request::input('year'))
        ->where('person_id',Request::input('person_id'))
        ->where('tracking_id','<>',Request::input('tracking_id'))
        ->get();

      

      if(count($yearExists) > 0){

          $person = db::table('ref_person')->where('person_id',Request::input('person_id'))->first();
          return $return->status(false)
                          ->message("Year already tracked for ".$person->last_name.", ".$person->first_name. " " .$person->middle_name.".")
                          ->show();
      }

        PersonIncomeModel::where('tracking_id' , Request::input('tracking_id'))->delete();
        PersonExpensesModel::where('tracking_id' , Request::input('tracking_id'))->delete();


        $PersonTracking            = PersonTracking::where('tracking_id', Request::input('tracking_id'));
        $PersonTracking->update([

              'year'            => Request::input('year')
        
        ]);

        if(Request::input('income_item') != "")
        {
            for($i = 0; $i <= count(Request::input('income_item')) - 1; $i++){  

                if(Request::input('income_item')[$i] != "" and Request::input('incomerates')[$i] != "") {

                  $IncomeItemModel             = IncomeItemModel::firstOrNew(['income_item' => Request::input('income_item')[$i]]);     
                  $IncomeItemModel->income_item = Request::input('income_item')[$i];
                  $IncomeItemModel->save();
                  $IncomeItemData = IncomeItemModel::where('income_item', '=', Request::input('income_item')[$i])->first();

                  $PersonIncomeModel                     = new PersonIncomeModel;
                  $PersonIncomeModel->income_item_id     = $IncomeItemData->income_item_id;
                  $PersonIncomeModel->income_expenses_id = Request::input('incomerates')[$i];
                  $PersonIncomeModel->tracking_id        = Request::input('tracking_id');
                  $PersonIncomeModel->save();
                } 
            }
        }


        if(Request::input('expenses_item') != ""){
            for($i = 0; $i <= count(Request::input('expenses_item')) - 1; $i++){  

                if(Request::input('expenses_item')[$i] != "" and Request::input('expenses_rates')[$i] != "") {

                  $ExpenseItemModel             = ExpenseItemModel::firstOrNew(['expenses_item' => Request::input('expenses_item')[$i]]);     
                  $ExpenseItemModel->expenses_item = Request::input('expenses_item')[$i];
                  $ExpenseItemModel->save();
                  $ExpenseItemModelData = ExpenseItemModel::where('expenses_item', '=', Request::input('expenses_item')[$i])->first();


                  $PersonExpensesModel                     = new PersonExpensesModel;
                  $PersonExpensesModel->expenses_item_id     = $ExpenseItemModelData->expenses_item_id;
                  $PersonExpensesModel->income_expenses_id = Request::input('expenses_rates')[$i];
                  $PersonExpensesModel->tracking_id        = Request::input('tracking_id');
                  $PersonExpensesModel->save();
                }
            }
        }

        PersonCreditModel::where('tracking_id' , Request::input('tracking_id'))->delete();

        foreach(Request::input('srcCredit') as $interest_id){


              $PersonCreditModel                = new PersonCreditModel;
              $PersonCreditModel->interest_id   = $interest_id;
              $PersonCreditModel->parents       = $this->torf(Request::input('parents'.$interest_id));
              $PersonCreditModel->relative      = $this->torf(Request::input('relative'.$interest_id));
              $PersonCreditModel->traders       = $this->torf(Request::input('traders'.$interest_id));
              $PersonCreditModel->diocese       = $this->torf(Request::input('diocese'.$interest_id));
              $PersonCreditModel->silingan      = $this->torf(Request::input('silingan'.$interest_id));
              $PersonCreditModel->govt          = $this->torf(Request::input('govt'.$interest_id));
              $PersonCreditModel->po            = $this->torf(Request::input('po'.$interest_id));
              $PersonCreditModel->fo            = $this->torf(Request::input('fo'.$interest_id));
              $PersonCreditModel->micro_finance = $this->torf(Request::input('micro_finance'.$interest_id)); 
              $PersonCreditModel->tracking_id   = Request::input('tracking_id');           
              $PersonCreditModel->save();
            
        }


        LtapModel::where('tracking_id' , Request::input('tracking_id'))->delete();

        for($i = 0; $i <= count(Request::input('land_name')) - 1; $i++){


            $OwnershipModel            = OwnershipModel::firstOrNew(['ownership' => Request::input('ownership')[$i]]);     
            $OwnershipModel->ownership = Request::input('ownership')[$i];
            $OwnershipModel->save();
            $OwnershipModelData        = OwnershipModel::where('ownership', '=', Request::input('ownership')[$i])->first();
            
            $LtapModel                 = new LtapModel;
            $LtapModel->ltap_name      = Request::input('land_name')[$i];
            $LtapModel->ltap_size      = Request::input('land_size')[$i];
            $LtapModel->land_status_id = Request::input('landstatus')[$i];
            $LtapModel->topography_id  = Request::input('topog_size')[$i];
            $LtapModel->ownership_id   = $OwnershipModelData->ownership_id;
            $LtapModel->tracking_id   = Request::input('tracking_id');      
            $LtapModel->save();
           
        }

        TanumKahayupanModel::where('tracking_id' , Request::input('tracking_id'))->delete();

        for($i = 0; $i <= count(Request::input('tk_name')) - 1; $i++){

            $TanumKahayupanModel                      = new TanumKahayupanModel;
            $TanumKahayupanModel->tk_name             = Request::input('tk_name')[$i];
            $TanumKahayupanModel->type_id             = Request::input('agri_type')[$i];
            $TanumKahayupanModel->status_id           = Request::input('agri_status')[$i];
            $TanumKahayupanModel->technology_apply_id = Request::input('techApply')[$i];
            $TanumKahayupanModel->input_used          = Request::input('input_used')[$i];
            $TanumKahayupanModel->tracking_id   = Request::input('tracking_id');     
            $TanumKahayupanModel->save();
           
        }

        return $return->status(true)
                            ->message("New tracking has been updated!.")
                            ->show();
    }

    public function editTrackingYear($id,$year){
        
        $income = DB::table('tblviewdatincome')
                ->where('year',$year)
                ->where('person_id',$id)
                ->get();

        $expenses = DB::table('tblviewdatexpenses')
                ->where('year',$year)
                ->where('person_id',$id)
                ->get();

        $interest = DB::table('tblviewdatinterest')
            ->where('year',$year)
            ->where('person_id',$id)
            ->get();
        
        $ltap = DB::table('tblviewltap')
            ->where('year',$year)
            ->where('person_id',$id)
            ->get();

        $tk = DB::table('tblviewtk')
            ->where('year',$year)
            ->where('person_id',$id)
            ->get();

        $track = DB::table('dat_tracking')
            ->where('year',$year)
            ->where('person_id',$id)
            ->first();

        $incomerates = DB::table('tblviewincomerates')->get();
        $housestatus = DB::table('tblviewhousestatus')->get();
        $housetype   = DB::table('tblviewhousetype')->get();
        $landstatus  = DB::table('tblviewlandstatus')->get();
        $topography  = DB::table('tblviewtopography')->get();
        $agri_type   = DB::table('ref_agri_type')->get();
        $agri_status = DB::table('ref_status')->get();
        $techApply   = DB::table('ref_technology_apply')->get();
        $user        = db::table('ref_person')->where('person_id',$id)->first();


        if(count($track) == 0){
            return view('admin.errors.unknown');
        }


        return view('bis.farmers.farmersEditTracking')
              ->with('tk',$tk)
              ->with('track',$track)
              ->with('year',$year)
              ->with('ltap',$ltap)
              ->with('user',$user)
              ->with('income',$income)
              ->with('agri_type',$agri_type)
              ->with('agri_status',$agri_status)
              ->with('techApply',$techApply)
              ->with('expenses',$expenses)
              ->with('incomerates',$incomerates)
              ->with('housestatus',$housestatus)
              ->with('housetype',$housetype)
              ->with('interest',$interest)
              ->with('landstatus',$landstatus)
              ->with('topography',$topography);
    }

    public function trackingYearsPerson($person_id){

        $data  = PersonTracking::where('person_id', $person_id)
          ->groupby('tracking_id')
          ->get();

        return $data;
    }

    public function torf($val){

        if($val == "on"){
          return 1;
        }
        else{ 
          return 0;
        }
    }

    public function editFarmer($id){

      $user          = db::table('tblviewfarmerinfo')->where('person_id',$id)->first();
      $userRelatives = db::table('tblviewrelatives')->where('person_id',$id)->get();

        return view('bis.farmers.edit-farmer-profile')
        	->with('user' , $user)
          ->with('userRelatives' , $userRelatives);
    }

    

    public function updateFarmerInfo(){

        $return = new rrdReturn();


        $tribe             = TribeModel::firstOrNew(['tribe_name' => Request::input('tribe_name')]);     
        $tribe->tribe_name = Request::input('tribe_name');
        $tribe->save();

        $tribeData = TribeModel::where('tribe_name', '=', Request::input('tribe_name'))->first();


        $civilStatus               = CivilStatusModel::firstOrNew(['civil_status' => Request::input('civil_status')]);     
        $civilStatus->civil_status = Request::input('civil_status');
        $civilStatus->save();

        $civilData = CivilStatusModel::where('civil_status', '=', Request::input('civil_status'))->first();


        $School             = SchoolAttainModel::firstOrNew(['attainment' => Request::input('sch_attainment')]);     
        $School->attainment = Request::input('sch_attainment');
        $School->save();

        $SchoolData = SchoolAttainModel::where('attainment', '=', Request::input('sch_attainment'))->first();


        $organization                    = OrganizationModel::firstOrNew(['organization_name' => Request::input('organization')]);     
        $organization->organization_name = Request::input('organization');
        $organization->save();

        $organizationData = OrganizationModel::where('organization_name', '=', Request::input('organization'))->first();


        $religion                = ReligionModel::firstOrNew(['religion_name' => Request::input('religion_name')]);     
        $religion->religion_name = Request::input('religion_name');
        $religion->save();
        $religionData            = ReligionModel::where('religion_name', '=', Request::input('religion_name'))->first();


        $designation               = DesignationModel::firstOrNew(['des_name' => Request::input('designation')]);     
        $designation->des_name = Request::input('designation');
        $designation->save();
        $designationData = DesignationModel::where('des_name', '=', Request::input('designation'))->first();



        $farmer                  = FarmerModel::where('person_id', '=', Request::input('person_id'));
        $farmer->update([

              'first_name'      => Request::input('first_name'),
              'middle_name'     => Request::input('middle_name'),
              'last_name'       => Request::input('last_name'),
              'spouse_name'     => Request::input('spouse_name'),
              'age'             => Request::input('age'),
              'gender'          => Request::input('gender'),
              'organization_id' => $organizationData->organization_id,
              'religion_id'     => $religionData->religion_id,
              'tribe_id'        => $tribeData->tribe_id,
              'des_id'          => $designationData->des_id,
              'civil_id'        => $civilData->civil_id,
              'start_of_crop'   => Request::input('start_crop'),
              'address'         => Request::input('home_address'),
              'sch_id'          => $SchoolData->sch_id

        ]);



        $personData = Request::input('person_id');

        RelativesModel::where('person_id',$personData)->delete();

        for($i=0; $i <= count(Request::input('h_age')) -1 ; $i++){

          $relationship               = RelationshipModel::firstOrNew(['relationship' => Request::input('relationship_name')[$i]]);     
          $relationship->relationship = Request::input('relationship_name')[$i];
          $relationship->save();

          $relationshipData = RelationshipModel::where('relationship', '=', Request::input('relationship_name')[$i])->first();

          $relatives                  = new RelativesModel;
          $relatives->person_id       = $personData;
          $relatives->age             = Request::input('h_age')[$i];
          $relatives->gender          = Request::input('h_gender')[$i];
          $relatives->relationship_id = $relationshipData->relationship_id;
          $relatives->save(); 
        }

        return $return->status(true)
                          ->message("That is amazing! it has been updated!.")
                          ->show();
    }
}	
