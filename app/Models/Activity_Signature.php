<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_Signature extends Model
{
    use HasFactory;

    protected $table="activity_signature";

    protected $fillable = [
        "activity_id",
        "signature_id",
    ];
}
