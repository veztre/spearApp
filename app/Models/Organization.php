<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Organization extends Model
{

    protected $fillable = [
        'name',
        'department'
    ];

    use HasFactory;

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
