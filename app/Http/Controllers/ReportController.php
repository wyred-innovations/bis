<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use DB;

use Pdf;

class ReportController extends Controller
{
    public function test_pdf(){

    	$pdf = Pdf::loadView('bis.reports.reports');
        
        return $pdf->setPaper('legal')->setOrientation('portrait')
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
}

