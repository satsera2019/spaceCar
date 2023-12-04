<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRequestLog extends Model
{
    use HasFactory;

    protected $table = 'api_request_logs';

    protected $fillable = [
        'session_id',
        'ip',
        'method',
        'address',
        'parameters',
        'response',
    ];

    protected $casts = [
        'parameters' => 'json', // If you're storing parameters as JSON
    ];
}
