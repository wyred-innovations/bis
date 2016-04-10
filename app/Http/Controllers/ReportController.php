<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pdf;
use App\Http\Requests;
use DB;
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

    	

    }

    public function getFarmersReports(){

    	$person = db::table('ref_person')->get();

        return view('bis.farmers.reports')
        		->with('person',$person);
    }
}

