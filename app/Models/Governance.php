<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governance extends Model
{
    /** @use HasFactory<\Database\Factories\GovernanceFactory> */
    use HasFactory;
    protected $table = 'governance';
    protected $guarded = [];
}
