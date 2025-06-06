<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppGeneralInfo extends Model
{
    protected $table = 'app_general_info';
    protected $guarded = [];
 
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
