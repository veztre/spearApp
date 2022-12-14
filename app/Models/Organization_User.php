<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization_User extends Model
{
    use HasFactory;

    protected $table = "organization_user";

    protected $fillable = [
        "user_id",
        "organization_id",
    ];
}
