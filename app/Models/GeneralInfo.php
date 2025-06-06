<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasFactory;

    protected $table = 'general_info';
    protected $guarded = [];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
