<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsterisUserModel extends Model
{
    use HasFactory;

    protected $connection = 'asterisk';
    protected $table = 'users';

    protected $guarded = [];

}
