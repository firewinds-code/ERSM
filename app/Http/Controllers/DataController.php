<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\ImportData;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\ClientData;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function index()
    {
        try {
            return view('uploaddata.excel');
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function export(Request $request)
    {
        try {
            $tablName = $request->name;
            // dd($tablName);
            $fileName = $tablName . '.csv';
            $columns = array_slice(Schema::getColumnListing($tablName), 1, -8);
            $columns = Schema::getColumnListing($tablName);
            $columns = DB::getSchemaBuilder()->getColumnListing($tablName);
            $columns = array_diff($columns, array('id', 'flag', 'call_back', 'followup', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'));
            // dd($columns);
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $callback = function () use ($columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }

    public function import(Request $request)
    {
        try {
            $beforeCount = ClientData::count();
            Excel::import(new ImportData(), $request->file('file'));
            $afterCount = ClientData::count(); // Count records after import
            $importedCount = $afterCount - $beforeCount;
            return redirect()->back()->with('success', "$importedCount data records imported successfully.");
        } catch (Exception $e) {
            return back()->with("error", "Something Went Wrong");
        }
    }
}
