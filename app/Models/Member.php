<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'ms_members';

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('street', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%");
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
}
