<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentInput extends Model
{
    use HasFactory;
    protected $table = 'agentinputs';

    protected $fillable = [
        'dataID',
        'source_of_calling',
        'calling_status',
        'connect_status',
        'remarks',
        'created_by',
    ];
}