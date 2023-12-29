<?php

use Illuminate\Support\Facades\DB;

function generateSourceOptions()
{
    $source_of_calling = [
        'Mobile' => 'Mobile',
        'Dialer' => 'Dialer',

    ];
    $options = '';
    foreach ($source_of_calling as $value => $label) {
        $options .= "<option value='$value'>$label</option>";
    }
    return $options;
}

function generateCallingOptions()
{
    $calling_status = [
        'Connected' => 'Connected',
        'Not Connected' => 'Not Connected',

    ];
    $options = '';
    foreach ($calling_status as $value => $label) {
        $options .= "<option value='$value'>$label</option>";
    }
    return $options;
}
function generateQuotationOptions()
{
    $years = [
        '1 Year' => '1 Year',
        '2 Years' => '2 Years',
        '3 Years' => '3 Years',

    ];
    $options = '';
    foreach ($years as $value => $label) {
        $options .= "<option value='$value'>$label</option>";
    }
    return $options;
}

function leadCount($flag)
{
    $leadCount = DB::table('ersm.client_data')
        ->where('flag', $flag)
        ->count();
    return $leadCount;
}