<?php

namespace App\Imports;

use App\Models\ClientData;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportData implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        return new ClientData([
            'vin_no'             => $row['vin_no'],
            'parent_id'          => $row['parent_id'],
            'customer_name'      => $row['customer_name'],
            'contact_no'         => $row['contact_no'],
            'usage_category'     => $row['usage_category'],
            'plant_code'         => $row['plant_code'],
            'dealer_name'        => $row['dealer_name'],
            'dealer_state'       => $row['dealer_state'],
            'bill_to_party_name' => $row['bill_to_party_name'],
            'device_type'        => $row['device_type'],
            'region'             => $row['region'],
            'customer_category'  => $row['customer_category'],
            'agent_id'           => $row['agent_id'],
            'created_by'         => Auth::user()->name
        ]);

        return back()->with('success', 'Data Uploaded successfully');
    }
}