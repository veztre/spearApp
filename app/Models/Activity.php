<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    
     use HasFactory;
     protected $table='activities';


    protected $fillable = [
        "purpose",
        "status",
        "venue",
        "priority",
        "startDate",
        "endDate",
        "user_id",
        "attachment"
    ];
     public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
