<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use Yajra\DataTables\Facades\DataTables;

use Carbon\Carbon;

class FilterController extends Controller
{
    public function index()
    {
        return view('filter-record');
    }

    public function filterRecord(Request $request)
    {
        if ($request->ajax()) {
            $filterType = $request->input('filter');
            $selected_date = $request->input('selected_date');
    
    
            $selected_date = Carbon::createFromFormat('Y-m-d', $selected_date)->format('m-d-Y');
            
            if ($filterType === 'day') {
                $start_date = Carbon::createFromFormat('m-d-Y', $selected_date)
                             ->subDays(7)
                             ->format('m-d-Y');
            } 
            elseif ($filterType === 'month') {
                $start_date = Carbon::createFromFormat('m-d-Y', $selected_date)
                            ->subDays(30)
                            ->format('m-d-Y');
            } 
            elseif ($filterType === 'year') {
                $start_date = Carbon::createFromFormat('m-d-Y', $selected_date)
                             ->subYear()
                             ->format('m-d-Y');
                
            }
    
    
            $data = DB::select("
                SELECT Job_, Borough, Initial_Cost, Latest_Action_Date 
                FROM dob_latest_action 
                WHERE STR_TO_DATE(Latest_Action_Date, '%m-%d-%Y') BETWEEN STR_TO_DATE(?, '%m-%d-%Y') 
                AND STR_TO_DATE(?, '%m-%d-%Y')  
                ORDER BY Initial_Cost desc
                LIMIT ?
            ", [$start_date, $selected_date, 50]);

            DB::statement("TRUNCATE TABLE top_permits");
    
            foreach ($data as $row) {
                DB::insert("
                    INSERT INTO top_permits (Job_, Borough, Initial_Cost, Latest_Action_Date) 
                    VALUES (?, ?, ?, ?)", [$row->Job_, $row->Borough, $row->Initial_Cost, $row->Latest_Action_Date]);
            }
    
            $alltop_permit = DB::select("SELECT Job_, Borough, Initial_Cost, Latest_Action_Date FROM top_permits");
    
            return DataTables::of($alltop_permit)->make(true);
        }
    
        
    }
    
    
    
}
