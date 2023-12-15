<?php

namespace App\Http\Controllers;

use App\Models\ClientData;
use App\Models\Disposition;
use Illuminate\Support\Facades\DB;
use App\Models\AgentInput;
use App\Models\ClickToCall;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Exception;

class ManageDataController extends Controller
{
    public function gettabledata(Request $request)
    {
        try {
            $id = $request->input('id');
            $userId = Auth::user()->empID;

            $query = ClientData::where('agent_id', $userId);

            if ($id == '0') {
                $query->where("flag", 0)
                    ->whereNull("call_back")
                    ->whereNull("followup")
                    ->where("status", "Fresh");
            } elseif ($id == '1') {
                $query->where("flag", 1)
                    ->whereNULL("call_back")
                    ->whereNotNull("followup")
                    ->where("status", "Follow Up");
            } elseif ($id == '2') {
                $query->where("flag", 2)
                    ->whereNotNull("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Call Back");
            } elseif ($id == '3') {
                $query->where("flag", 3)
                    ->whereNULL("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Not Connected");
            } elseif ($id == '4') {
                $query->where("flag", 4)
                    ->whereNULL("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Closed");
            } elseif ($id == '5') {
                $query->where("flag", 5)
                    ->whereNULL("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Payment Done");
            } elseif ($id == '6') {
                $query->where("flag", 6)
                    ->whereNULL("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Not Interested");
            } elseif ($id == '7') {
                $query->where("flag", 7)
                    ->whereNULL("call_back")
                    ->whereNULL("followup")
                    ->where("status", "Ready for Renewal - Dealer");
            } else {
                $query->whereRaw('0');
            }

            $results = $query->get()->toArray();

            if (sizeof($results) > 0) {
                $html = view('managedata.tableData', compact('results'))->render();

                // Add JavaScript code to reload the page
                $javascript = "<script>window.location.reload();</script>";

                return response()->json(['message' => 'Data found', 'html' => $html, 'javascript' => $javascript, 'status' => true], 200);
            } else {
                return response()->json(['message' => 'Data not found', 'status' => false], 200);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json(['message' => $message, 'status' => false], 200);
        }
    }

    public function freshlist(Request $request)
    {
        try {
            $user = Auth::user()->usertype;
            if ($user == '1') {
                $freshcount = ClientData::where('flag', 0)
                    ->count();
                $followupcount = ClientData::where('flag', 1)
                    ->count();
                $callbackcount = ClientData::where('flag', 2)
                    ->count();
                $notconnectedcount = ClientData::where('flag', 3)
                    ->count();
                $closedcount = ClientData::where('flag', 4)
                    ->count();
                $paymentdone = ClientData::where('flag', 5)
                    ->count();
                $notinterested = ClientData::where('flag', 6)
                    ->count();
                $readyforrenew = ClientData::where('flag', 7)
                    ->count();
            } else {
                $agentId = Auth::user()->empID;
                $freshcount = ClientData::where('flag', 0)
                    ->where('agent_id', $agentId)
                    ->count();
                $followupcount = ClientData::where('flag', 1)
                    ->where('agent_id', $agentId)
                    ->count();
                $callbackcount = ClientData::where('flag', 2)
                    ->where('agent_id', $agentId)
                    ->count();
                $notconnectedcount = ClientData::where('flag', 3)
                    ->where('agent_id', $agentId)
                    ->count();
                $closedcount = ClientData::where('flag', 4)
                    ->where('agent_id', $agentId)
                    ->count();
                $paymentdone = ClientData::where('flag', 5)
                    ->where('agent_id', $agentId)
                    ->count();
                $notinterested = ClientData::where('flag', 6)
                    ->where('agent_id', $agentId)
                    ->count();
                $readyforrenew = ClientData::where('flag', 7)
                    ->where('agent_id', $agentId)
                    ->count();
            }
            return view('managedata.fresh', compact('freshcount', 'followupcount', 'callbackcount', 'notconnectedcount', 'closedcount', 'paymentdone', 'notinterested', 'readyforrenew'));
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function freshedit(Request $request)
    {
        try {
            $data = ClientData::where('id', $request->id)->first();
            $vin_nos = ClientData::where('parent_id', $data->parent_id)
                ->select('vin_no')
                ->limit(5)
                ->get();

            $vinCounts =  DB::table('ersm.client_data')
                ->where('parent_id', '=', $data->parent_id)
                ->count('vin_no');
                
            $results = AgentInput::where('dataID', $request->id)->get();
            $html = view('managedata.freshedit', compact('data', 'results', 'vinCounts', 'vin_nos'))->render();
            return response()->json(['html' => $html, 'status' => true]);
        } catch (Exception $e) {
            return response()->json(['html' => "Something went wrong!", 'status' => false]);
        }
    }

    public function disposition(Request $req)
    {
        $callingstatus = $req['selectedCallingStatus'];
        $connectstatus = Disposition::select('connect_status')->where('calling_status', $callingstatus)->get();
        return $connectstatus;
    }

    public function update(Request $request)
    {
        try {
            // dd($request->all());
            if ($request->calling_status == 'Not Connected') {
                $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                foreach ($data as $row) {
                    AgentInput::insert(
                        [
                            'dataID' => $row['id'],
                            'source_of_calling' => $request->source_of_calling,
                            'calling_status' => $request->calling_status,
                            'connect_status' => $request->connect_status,
                            'year' => $request->quotation,
                            'call_back' => NULL,
                            'followup' => NULL,
                            'price' => $request->price,
                            'remarks' => $request->remarks,
                            'created_by' => Auth::user()->name,
                        ]
                    );
                    ClientData::where('id', $row['id'])
                        ->update([
                            'call_back' => NULL,
                            'followup' => NULL,
                            'status' => 'Not Connected',
                            'flag' => 3,
                            'updated_by' => Auth::user()->name,
                        ]);
                }
                return back()->with('success', 'Details Updated Successfully');
            } else {
                $connectStatusArray = ['Not Interested - High Renewal Cost', 'Not Interested - Reason not Shared', 'Not Interested - Using third party', 'Not Interested - Sold vehicle', 'Not Interested - RPC Not Available', 'Not Interested - RTO issue', 'Not Interested - Service issue', 'Not Interested - Accident vehicle', 'Not Interested - GPS Issue', 'Not Interested - services issue from Dealer', 'Not Interested - Financial issue', 'Not Interested - Not interested-local area', 'Not Interested - Not Interested-Driver is owner', 'Not Interested - Customer want free subscription', 'Not Interested - Customer Not Aware of Service'];
                $connectStatusfollow = ['Follow Up - Quotation Sent', 'Follow Up - Ready for Payment', 'Follow Up - Ready for Renewal'];

                $callinputDate = $request->call_back;
                $followinputDate = $request->follow_ups;
                if ($request->connect_status == 'Call Back') {
                    if (!empty($callinputDate) && empty($followinputDate)) {
                        $callDate = Carbon::createFromFormat('m/d/Y g:i A', $callinputDate);
                        $callFormatted = $callDate->format('Y-m-d H:i:s');
                        $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                        foreach ($data as $row) {
                            AgentInput::Insert(
                                [
                                    'dataID' => $request->id_edit,
                                    'source_of_calling' => $request->source_of_calling,
                                    'calling_status' => $request->calling_status,
                                    'connect_status' => $request->connect_status,
                                    'year' => $request->quotation,
                                    'call_back' => $callFormatted,
                                    'price' => $request->price,
                                    'remarks' => $request->remarks,
                                    'created_by' => Auth::user()->name,
                                ]
                            );
                            ClientData::where('id', $request->id_edit)
                                ->update([
                                    'call_back' => $callFormatted,
                                    'followup' => null,
                                    'status' => 'Call Back',
                                    'flag' => 2,
                                    'updated_by' => Auth::user()->name,
                                ]);
                        }
                        return back()->with('success', 'Details Updated Successfully');
                    } else {
                        return back()->with('error', 'Call Back date is compulsory for Call Back.');
                    }
                } else if (in_array($request->connect_status, $connectStatusfollow)) {
                    if (empty($callinputDate) && !empty($followinputDate)) {
                        $followDate = Carbon::createFromFormat('m/d/Y g:i A', $followinputDate);
                        $followFormatted = $followDate->format('Y-m-d H:i:s');
                        $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                        foreach ($data as $row) {
                            AgentInput::Insert(
                                [
                                    'dataID' => $request->id_edit,
                                    'source_of_calling' => $request->source_of_calling,
                                    'calling_status' => $request->calling_status,
                                    'connect_status' => $request->connect_status,
                                    'year' => $request->quotation,
                                    'followup' => $followFormatted,
                                    'price' => $request->price,
                                    'remarks' => $request->remarks,
                                    'created_by' => Auth::user()->name,
                                ]
                            );
                            $row = ClientData::where('id', $request->id_edit)->first();
                            ClientData::where('id', $request->id_edit)
                                ->update([
                                    'followup' => $followFormatted,
                                    'call_back' => null,
                                    'status' => 'Follow Up',
                                    'flag' => 1,
                                    'updated_by' => Auth::user()->name,
                                ]);
                        }
                        return back()->with('success', 'Details Updated Successfully');
                    } else {
                        return back()->with('error', 'Follow Up date is compulsory for Follow Up.');
                    }
                } else if ($request->connect_status == 'Payment Done') {
                    $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                    foreach ($data as $row) {
                        AgentInput::Insert(
                            [
                                'dataID' => $request->id_edit,
                                'source_of_calling' => $request->source_of_calling,
                                'calling_status' => $request->calling_status,
                                'connect_status' => $request->connect_status,
                                'year' => $request->quotation,
                                'price' => $request->price,
                                'remarks' => $request->remarks,
                                'created_by' => Auth::user()->name,
                            ]
                        );
                        ClientData::where('id', $request->id_edit)
                            ->update([
                                'followup' => Null,
                                'call_back' => null,
                                'status' => 'Payment Done',
                                'flag' => 5,
                                'updated_by' => Auth::user()->name,
                            ]);
                    }
                    return back()->with('success', 'Details Updated Successfully');
                } else if ($request->connect_status == 'Ready for Renewal - Dealer') {
                    $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                    foreach ($data as $row) {
                        AgentInput::Insert(
                            [
                                'dataID' => $request->id_edit,
                                'source_of_calling' => $request->source_of_calling,
                                'calling_status' => $request->calling_status,
                                'connect_status' => $request->connect_status,
                                'year' => $request->quotation,
                                'price' => $request->price,
                                'remarks' => $request->remarks,
                                'created_by' => Auth::user()->name,
                            ]
                        );
                        ClientData::where('id', $request->id_edit)
                            ->update([
                                'followup' => Null,
                                'call_back' => null,
                                'status' => 'Ready for Renewal - Dealer',
                                'flag' => 7,
                                'updated_by' => Auth::user()->name,
                            ]);
                    }
                    return back()->with('success', 'Details Updated Successfully');
                } else if (in_array($request->connect_status, $connectStatusArray)) {
                    $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                    foreach ($data as $row) {
                        AgentInput::Insert(
                            [
                                'dataID' => $request->id_edit,
                                'source_of_calling' => $request->source_of_calling,
                                'calling_status' => $request->calling_status,
                                'connect_status' => $request->connect_status,
                                'year' => $request->quotation,
                                'price' => $request->price,
                                'remarks' => $request->remarks,
                                'created_by' => Auth::user()->name,
                            ]
                        );
                        ClientData::where('id', $request->id_edit)
                            ->update([
                                'followup' => Null,
                                'call_back' => null,
                                'status' => 'Not Interested',
                                'flag' => 6,
                                'updated_by' => Auth::user()->name,
                            ]);
                    }
                    return back()->with('success', 'Details Updated Successfully');
                } else {
                    $data = ClientData::where('parent_id', $request->parent_id)->get()->toArray();
                    foreach ($data as $row) {
                        AgentInput::Insert(
                            [
                                'dataID' => $request->id_edit,
                                'source_of_calling' => $request->source_of_calling,
                                'calling_status' => $request->calling_status,
                                'connect_status' => $request->connect_status,
                                'year' => $request->quotation,
                                'price' => $request->price,
                                'remarks' => $request->remarks,
                                'created_by' => Auth::user()->name,
                            ]
                        );
                        ClientData::where('id', $request->id_edit)
                            ->update([
                                'followup' => NULL,
                                'call_back' => null,
                                'status' => 'Closed',
                                'flag' => 4,
                                'updated_by' => Auth::user()->name,
                            ]);
                    }
                    return back()->with('success', 'Details Updated Successfully');
                }
            }
            return back()->with('error', 'Details Not Updated Successfully');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function call(Request $request)
    {
        try {
            $pri_no = Auth::user()->pri_no;
            $email = Auth::user()->email;
            $data_id = $request->data_id;
            $mobile = $request->mobile_no;

            if (!is_null($pri_no)) {
                // dd("ebfelb");
                $url = "http://easygovoice.com/csc_url_api?api_key=53f714f360567740&pass=E51Frwd7By&empid=" . $email . "&AgentNo=" . $pri_no . "&CustomerNo=" . $mobile;
                $res = Http::get($url);
                $resp = ($res->body());
                $respon = json_decode($resp);
                if (!is_null($respon)) {
                    ClickToCall::insert([
                        "data_id" => $data_id,
                        "agent_id" => $email,
                        "pri_no" => $pri_no,
                        "mobile" => $mobile,
                        "response" => $resp,
                        "req_url" => $url
                    ]);

                    if ($respon->status == "200") {

                        return response()->json(['message' => 'Call In Process.', 'status' => true]);
                    } else {

                        ClickToCall::insert([
                            "data_id" => $data_id,
                            "agent_id" => $email,
                            "pri_no" => $pri_no,
                            "mobile" => $mobile,
                            "response" => $resp,
                            "req_url" => $url
                        ]);
                        return response()->json(['message' => 'Something went Wrong With API Setting.', 'status' => false]);
                    }
                } else {

                    ClickToCall::insert([
                        "data_id" => $data_id,
                        "agent_id" => $email,
                        "pri_no" => $pri_no,
                        "mobile" => $mobile,
                        "response" => $resp,
                        "req_url" => $url
                    ]);
                    return response()->json(['message' => 'Something went Wrong With API.', 'status' => false]);
                }
            } else {

                return response()->json(['message' => 'Please Add PRI Number.', 'status' => false]);
            }
        } catch (Exception $e) {

            $message = $e->getMessage();
            $message = "Something went wrong!";
            return response()->json(['message' => $message, 'status' => false]);
        }
    }
}