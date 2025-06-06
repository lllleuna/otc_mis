<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUnit extends Model
{
    protected $table = 'app_units';
    protected $guarded = [];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
