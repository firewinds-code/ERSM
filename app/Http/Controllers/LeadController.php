<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    public function leadtransfer()
    {
        try {
            $agents = DB::table('ersm.users')
                ->select('*')
                ->where('usertype', '=', '2')
                ->get();
            return view('lead.leadtransfer', compact('agents'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
    public function getNewAgents(Request $request)
    {
        $oldAgentId = $request->input('selectedOldAgentId');
        $newAgents = DB::table('ersm.users')
            ->select('empID', 'name')
            ->where('usertype', '=', '2')
            ->where('empID', '!=', $oldAgentId)
            ->get();


        return $newAgents;
    }

    public function leadupdate(Request $request)
    {
        try {
            $old_agent = $request->old_agent;
            $new_agent_value = $request->new_agent;
            DB::table('ersm.client_data')
                ->where('agent_id', $old_agent)
                ->update(['agent_id' => $new_agent_value]);

            DB::table('ersm.lead_log')->insert([
                'new_agent_id' => $new_agent_value,
                'old_agent_id' => $old_agent,
                'transfered_by' => auth()->user()->empID
            ]);

            return back()->with('success', 'Leads Transfered Successfully');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function leadlog()
    {
        try {
            $threeMonthsAgo = now()->subMonths(3)->toDateString();

            $data = DB::table('ersm.lead_log')
                ->select('*')
                ->whereDate('created_at', '>=', $threeMonthsAgo)
                ->get();

            return view('lead.leadlog', compact('data'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}