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

            $income = db::table('tblviewreportincome')
                ->where('year','>=',Request::input('start'))
                ->where('year','<=',Request::input('end'))
                ->orderby('year','asc')
                ->orderby('person_id','asc')
                ->get();

            $expenses = db::table('tblviewreportexpenses')
                    ->where('year','>=',Request::input('start'))
                    ->where('year','<=',Request::input('end'))
                    ->orderby('year','asc')
                    ->orderby('person_id','asc')
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

/*        return view('bis.reports.trackYears')
                    ->with('finalExpensesData',$finalExpensesData)
                    ->with('sorter',$sorter)
                    ->with('finalIncomeData',$finalIncomeData);
*/
        if(Request::input("sub_category") == "All"){

            $pdf = Pdf::loadView('bis.reports.trackYearsAllPeople',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
            
            dd($finalExpensesData);

        }else{

            $pdf = Pdf::loadView('bis.reports.trackYears',['sorter'=> $sorter,'finalExpensesData' => $finalExpensesData,'finalIncomeData' => $finalIncomeData]);
        }
     
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

