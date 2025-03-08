<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSeminar extends Model
{
    /** @use HasFactory<\Database\Factories\TrainingSeminarFactory> */
    use HasFactory;

    protected $table = 'trainings_seminars';

    protected $guarded = [];
}
