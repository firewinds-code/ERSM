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
            if (Auth::user()->usertype == '2') {
                $data = DB::table('client_data')
                    ->join('agentinputs', 'client_data.id', '=', 'agentinputs.dataID')
                    ->join('users', 'client_data.agent_id', '=', 'users.empID')
                    ->select("*")
                    ->where('client_data.agent_id', $User)
                    ->whereRaw('DATE(agentinputs.created_at) BETWEEN ? AND ?', [date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate))])
                    ->get();
            } else {
                $data = DB::table('client_data')
                    ->join('agentinputs', 'client_data.id', '=', 'agentinputs.dataID')
                    ->join('users', 'client_data.agent_id', '=', 'users.empID')
                    ->select("*")
                    ->whereRaw('DATE(agentinputs.created_at) BETWEEN ? AND ?', [date('Y-m-d', strtotime($startDate)), date('Y-m-d', strtotime($endDate))])
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
                ->select("*")
                ->whereBetween(DB::raw('DATE(created_at)'), [$endDate, $startDate])
                ->orderBy('id', 'desc')
                ->get();

            if ($data) {
                return view('report.calllog', compact('data'));
            }
            return view('report.calllog');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}