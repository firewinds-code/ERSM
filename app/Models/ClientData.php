<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    use HasFactory;

    protected $table = 'client_data';

    protected $fillable = [
        'vin_no',
        'parent_id',
        'customer_name',
        'contact_no',
        'usage_category',
        'plant_code',
        'dealer_name',
        'dealer_state',
        'bill_to_party_name',
        'device_type',
        'region',
        'customer_category',
        'agent_id',
        'created_by',
    ];
}