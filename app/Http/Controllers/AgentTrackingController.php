<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgentTrackingController extends Controller
{
    public function list(Request $request)
    {
        try {
            $flagCounts = DB::table('ersm.client_data')
                ->join('users', 'client_data.agent_id', '=', 'users.empID')
                ->select('name')
                ->selectRaw("SUM(CASE WHEN flag = '0' THEN 1 ELSE 0 END) as 'flag 0'")
                ->selectRaw("SUM(CASE WHEN flag = '1' THEN 1 ELSE 0 END) as 'flag 1'")
                ->selectRaw("SUM(CASE WHEN flag = '2' THEN 1 ELSE 0 END) as 'flag 2'")
                ->selectRaw("SUM(CASE WHEN flag = '3' THEN 1 ELSE 0 END) as 'flag 3'")
                ->selectRaw("SUM(CASE WHEN flag = '4' THEN 1 ELSE 0 END) as 'flag 4'")
                ->selectRaw("SUM(CASE WHEN flag = '5' THEN 1 ELSE 0 END) as 'flag 5'")
                ->selectRaw("SUM(CASE WHEN flag = '6' THEN 1 ELSE 0 END) as 'flag 6'")
                ->selectRaw("SUM(CASE WHEN flag = '7' THEN 1 ELSE 0 END) as 'flag 7'")
                ->groupBy('empID', 'name')
                ->get();

            return view('agent.table', compact('flagCounts'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}