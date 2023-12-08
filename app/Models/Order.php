<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeSearch($query, $search)
    {
        return $query->where('orderBy', 'like', "%$search%");
//            ->orWhere('phone', 'like', "%$search%");
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }

}
