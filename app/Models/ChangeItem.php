<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeItem extends Model
{
    /** @use HasFactory<\Database\Factories\ChangeItemFactory> */
    use HasFactory;
    protected $table = 'change_items';

    protected $guarded = [];
}
