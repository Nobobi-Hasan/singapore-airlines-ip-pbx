<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsterisCdrModel extends Model
{
    use HasFactory;

    protected $connection = 'asteriskcdrdb';
    protected $table = 'cdr';

    protected $guarded = [];
}
