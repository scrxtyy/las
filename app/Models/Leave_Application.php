<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave_Application extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'employeeID');
    }
    use HasFactory;
    protected $fillable = [
        'employeeID',
        'from',
        'to',
        'reason',
        'status',   
        'reasonSpecified',
        'referenceID',
        'authorizedBy',
    ];
}
