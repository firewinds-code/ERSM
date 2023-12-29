<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use DateTime;

class ReportController extends Controller
{
    public function report()
    {
        try {
            return view('report.report');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function daterange(Request $request)
    {
        try {
            $User = Auth::user()->empID;
            $array = explode("@", $request->dateRangehid);
            $startDate = $array[0];
            $endDate = $array[1];
            $start_Date = date('Y-m-d', strtotime($startDate));
            $end_Date = date('Y-m-d', strtotime($endDate));
            $selectArr = array(
                'client_data.*',
                'agentinputs.*',
                'users.*',
                'agentinputs.created_at as acreatedAt',
                'agentinputs.updated_at as cupdated_at'
            );
            if (Auth::user()->usertype == '2') {
                $data = DB::table('client_data')
                    ->join('agentinputs', 'client_data.id', '=', 'agentinputs.dataID')
                    ->join('users', 'client_data.agent_id', '=', 'users.empID')
                    ->select($selectArr)
                    ->where('client_data.agent_id', $User)
                    ->whereBetween(DB::raw('DATE(agentinputs.created_at)'), [$start_Date, $end_Date])
                    ->get();
            } else {
                $data = DB::table('client_data')
                    ->join('agentinputs', 'client_data.id', '=', 'agentinputs.dataID')
                    ->join('users', 'client_data.agent_id', '=', 'users.empID')
                    ->select($selectArr)
                    ->whereBetween(DB::raw('DATE(agentinputs.created_at)'), [$start_Date, $end_Date])
                    ->get();
            }
            return view('report.report', compact('data'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function calllog()
    {
        try {
            $currentDate = new DateTime();
            $startDate = $currentDate->format('Y-m-d h:i:s');
            $endDate = $currentDate->modify('-3 days')->format('Y-m-d h:i:s');
            $data = DB::table('click_to_calls')
                ->join('client_data', 'click_to_calls.data_id', '=', 'client_data.id')
                ->select("*")
                ->whereBetween(DB::raw('DATE(click_to_calls.created_at)'), [$endDate, $startDate])
                ->orderBy('click_to_calls.created_at', 'desc')
                ->get();
            // dd($data);
            if ($data) {
                return view('report.calllog', compact('data'));
            }
            return view('report.calllog');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }
}
