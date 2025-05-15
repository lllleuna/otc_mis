<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EditRequest extends Model
{
    use HasFactory;
    protected $table = 'edit_requests';
    protected $guarded = [];

    public function changeItems(): HasMany
    {
        return $this->hasMany(ChangeItem::class, 'edit_request_id');
    }
}
