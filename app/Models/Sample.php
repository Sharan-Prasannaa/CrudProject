<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory; #for generating fake data in models. Testing purpose.

    protected $table = 'sample'; //Define table name

    protected $fillable = [
        'name',
        'email',
        'age',
        'description',
        'is_active',
        'dob',
        'gender',
        'role',
        'status',
        'profile_picture',
        'preferences',
        'user_id',
    ];

}
