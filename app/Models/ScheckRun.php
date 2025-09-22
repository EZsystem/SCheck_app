<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheckRun extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function setting(): HasOne
    {
        return $this->hasOne(ScheckSetting::class, 'run_id');
    }

    public function site(): HasOne
    {
        return $this->hasOne(ScheckSite::class, 'run_id');
    }

    public function result(): HasOne
    {
        return $this->hasOne(ScheckResult::class, 'run_id');
    }

    public function generalRanges(): HasMany
    {
        return $this->hasMany(ScheckGeneralRange::class, 'run_id');
    }

    public function topRanges(): HasMany
    {
        return $this->hasMany(ScheckTopRange::class, 'run_id');
    }
}

