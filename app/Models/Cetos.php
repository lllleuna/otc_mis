<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetos extends Model
{
    /** @use HasFactory<\Database\Factories\CetosFactory> */
    use HasFactory;

    protected $table = 'cetos';
    protected $guarded = [];

}
