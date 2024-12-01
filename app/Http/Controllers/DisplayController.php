<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;
class DisplayController extends Controller
{

    public function table()
       {
           return view('display-record');
       }
    public function fetchRecords(Request $request)
    {
       
        if ($request->ajax()) {
            $data = DB::table('dob_latest_action')
                ->select('Job_', 'Borough', 'Street_Name', 'Job_Type', 'Latest_Action_Date');
                
            return DataTables::of($data)->make(true);
        }
        

    
    }
    
}
