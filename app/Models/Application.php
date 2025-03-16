<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = '';

    public function statusHistories()
    {
        return $this->hasMany(ApplicationStatusHistory::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $maxId = Application::max('id') + 1;
            $application->reference_number = 'APP-' . str_pad($maxId, 6, '0', STR_PAD_LEFT);
        });
    }
}
