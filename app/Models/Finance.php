<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    /** @use HasFactory<\Database\Factories\FinanceFactory> */
    use HasFactory;

    protected $guarded = [];
}
