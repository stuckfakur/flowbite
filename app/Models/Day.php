<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'ms_days';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%$search%")
            ->orWhere('start_date', 'like', "%$search%")
            ->orWhere('end_date', 'like', "%$search%");
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }


}
