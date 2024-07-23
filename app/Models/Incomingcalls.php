<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomingcalls extends Model
{
    use HasFactory;
    protected $fillable = [
        'branchcalled',
        'drug',        
        'response',
        'branchthatcalled',
        
    ];
}
