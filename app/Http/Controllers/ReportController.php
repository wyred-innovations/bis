<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;

use Pdf;

class ReportController extends Controller
{
    public function test_pdf(){

    	$pdf = Pdf::loadView('bis.reports.reports');
        
        return $pdf->setPaper('letter')->setOrientation('portrait')
                    ->setOption('margin-bottom', 0)
                    ->setOption('margin-left', 0)
                    ->setOption('margin-top', 0)
                    ->stream('report.pdf');
    }

    public function bargraphGuiReport(){

    	$incomeGraph = db::table('tblviewgraph')
    			->where('person_id',Request::input('person_id'))
    			->where('year','>=',Request::input('start'))
    			->where('year','<=',Request::input('end'))
    			->orderby('year','asc')
    			->get();

    	return $incomeGraph;

    }

    public function getFarmersReports(){

    	$person = db::table('ref_person')
    		->get();

        return view('bis.farmers.reports')
        		->with('person',$person);
    }

    public function trackYears(){

        $return = new rrdReturn();

        $validator = Validator::make(
            [
                'sub_category'     => Request::input('sub_category'),
                'start'     => Request::input('start'),
                'end'     => Request::input('end')

            ],
            [
                'sub_category'        => 'required',
                'start'        => 'required',
                'end'        => 'required'
               
            ]
        );

        if ($validator->fails())
        {
            return "<label>".$validator->errors()->first()."</label>";

        }

        if(Request::input("sub_category") == "All"){

            return $this->allFarmerReport();

        }else{

            
            $income = db::table('tblviewreportincome')
                    ->where('person_id',Request::input('sub_category'))
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->get();

            $expenses = db::table('tblviewreportexpenses')
                    ->where('person_id',Request::input('sub_category'))
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->get();
        }


        if(count($income) == 0){
            return "nothing to show";
        }


        $person =  array();
        $av =  array();
        $year =  array();
        $tempYear = "";
        $personHolder = "";
        $finalData = array();

      
        

        foreach ($income as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                $tempYear =  $value->year;
                $year[] = $value->year;

            }

        }

        foreach($year as $yearValue){

            foreach($income as $dataValue){

                    if($yearValue == $dataValue->year){

                        $finalIncomeData[$yearValue][] = $dataValue;
                    }
                }
        }

        
        
        
        $year = "";
        
        foreach ($expenses as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                $tempYear =  $value->year;
                $year[] = $value->year;

            }

        }


        foreach($year as $yearValue){

            foreach($expenses as $dataValue){

                if($yearValue == $dataValue->year){

                    $finalExpensesData[$yearValue][] = $dataValue;
                }
            }

        }





        $sorter = Request::all();

        $pdf = Pdf::loadView('bis.reports.trackYears',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
        
     
        return $pdf->setPaper('letter')->setOrientation('portrait')
                    ->setOption('margin-bottom', 10)
                    ->setOption('margin-left', 10)
                    ->setOption('margin-top', 10)
                    ->setOption('enable-javascript', true)
                    ->setOption('javascript-delay', 1000)
                    ->stream('reports.pdf');

    }

    public function allFarmerReport(){

        $income = db::table('tblviewreportincome')
                ->where('year','>=',Request::input('start'))
                ->where('year','<=',Request::input('end'))
                ->orderby('person_id','asc')
                ->orderby('year','asc')
                ->get();

        $expenses = db::table('tblviewreportexpenses')
                ->where('year','>=',Request::input('start'))
                ->where('year','<=',Request::input('end'))
                ->orderby('person_id','asc')
                ->orderby('year','asc')
                ->get();


        if(count($income) == 0){
            return "nothing to show";
        }


        $person =  array();
        $av =  array();
        $year =  array();
        $tempYear = "";
        $personHolder = "";
        $finalData = array();


         /*PERSON LOOPING*/

        foreach ($income as $key => $value) {
            
            if($personHolder == ""){
                $personHolder =  $value->person_id;
                $person[] = $value->person_id;
            }
            if($personHolder != $value->person_id){

                $personHolder =  $value->person_id;
                $person[] = $value->person_id;
            }
        }
        
        

         /*INCOME LOOPING*/
        
       
        $yearCount = 0;
        foreach ($income as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                foreach ($year as $keyYear => $yearVal) {

                    if($yearVal == $value->year){
                        $yearCount++;
                    }

                }

                if($yearCount == 0 ){

                        $tempYear =  $value->year;
                        $year[] = $value->year;
                }
            }

        }   


        foreach($person as $personValue){


            foreach($income as $dataValue){
                
                if($personValue == $dataValue->person_id){

                    foreach($year as $yearValue){

                        if($yearValue == $dataValue->year){

                            $finalIncomeData[$personValue][$yearValue][] = $dataValue;
                        }
                    }
                }

            }
        }



        /*EXPENSES LOOPING*/
        $year = [];

        $yearCount = 0;
        foreach ($expenses as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                foreach ($year as $keyYear => $yearVal) {

                    if($yearVal == $value->year){
                        $yearCount++;
                    }

                }

                if($yearCount == 0 ){

                        $tempYear =  $value->year;
                        $year[] = $value->year;
                }
            }

        }


        foreach($person as $personValue){

            foreach($expenses as $dataValue){

                if($personValue == $dataValue->person_id){
                    
                    foreach($year as $yearValue){

                        if($yearValue == $dataValue->year){

                            $finalExpensesData[$personValue][$yearValue][] = $dataValue;
                        }
                    }
                }

            }
        }







        $sorter = Request::all();

        return view('bis.reports.trackYearsAllPeople')
                ->with('sorter', $sorter)
                ->with('finalExpensesData', $finalExpensesData)
                ->with('finalIncomeData', $finalIncomeData);



        $pdf = Pdf::loadView('bis.reports.trackYearsAllPeople',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
            

        return $pdf->setPaper('letter')->setOrientation('portrait')
                    ->setOption('margin-bottom', 10)
                    ->setOption('margin-left', 10)
                    ->setOption('margin-top', 10)
                    ->setOption('enable-javascript', true)
                    ->setOption('javascript-delay', 1000)
                    ->stream('reports.pdf');
    }

    public function bargraph(){


        $return = new rrdReturn();

        $validator = Validator::make(
            [
                'sub_category'     => Request::input('sub_category'),
                'start'     => Request::input('start'),
                'end'     => Request::input('end')

            ],
            [
                'sub_category'        => 'required',
                'start'        => 'required',
                'end'        => 'required'
               
            ]
        );

        if ($validator->fails())
        {
            return "<label>".$validator->errors()->first()."</label>";

        }

        if(Request::input("sub_category") == "All"){

            $income = db::table('tblviewreportincome')
                ->where('year','>=',Request::input('start'))
                ->where('year','<=',Request::input('end'))
                ->orderby('year','asc')
                ->get();

            $expenses = db::table('tblviewreportexpenses')
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->get();
        }else{

            
            $income = db::table('tblviewreportincome')
                    ->where('person_id',Request::input('sub_category'))
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->get();

            $expenses = db::table('tblviewreportexpenses')
                    ->where('person_id',Request::input('sub_category'))
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->get();
        }


        if(count($income) == 0){
            return "nothing to show";
        }


        $final =  array();
        $av =  array();
        $year =  array();
        $tempYear = "";


        $finalData = array();

        foreach ($income as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $final[][] = $value;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                $tempYear =  $value->year;
                $final[][] = $value;
                $year[] = $value->year;

            }

        }


        foreach($year as $yearValue){

            foreach($income as $dataValue){

                if($yearValue == $dataValue->year){

                    $finalIncomeData[$yearValue][] = $dataValue;
                }
            }

        }




        foreach ($expenses as $key => $value) {
            
            if($tempYear == ""){
                $tempYear =  $value->year;
                $final[][] = $value;
                $year[] = $value->year;
            }

            if($tempYear != $value->year){

                $tempYear =  $value->year;
                $final[][] = $value;
                $year[] = $value->year;

            }

        }


        foreach($year as $yearValue){

            foreach($expenses as $dataValue){

                if($yearValue == $dataValue->year){

                    $finalExpensesData[$yearValue][] = $dataValue;
                }
            }

        }




        $sorter = Request::all();

        return view('bis.reports.bargraph')
                    ->with('finalExpensesData',$finalExpensesData)
                    ->with('sorter',$sorter)
                    ->with('finalIncomeData',$finalIncomeData);
                    
        if(Request::input("sub_category") == "All"){

            
             
            $pdf = Pdf::loadView('bis.reports.trackYearsAllPeople',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
        }else{
            $pdf = Pdf::loadView('bis.reports.trackYears',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
        }
       /* $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 12000);

        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);*/

        
    }
    public function trackInfo($id){

        

    }
}

