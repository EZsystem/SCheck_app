<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'environment_data',
        'site_data',
        'calculation_results',
        'is_safe',
        'safety_notes',
        'completed_at',
    ];

    protected $casts = [
        'environment_data' => 'array',
        'site_data' => 'array',
        'calculation_results' => 'array',
        'is_safe' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * ユーザーとのリレーション
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 環境条件データを取得
     */
    public function getEnvironmentValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->environment_data, $key, $default);
    }

    /**
     * 現場条件データを取得
     */
    public function getSiteValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->site_data, $key, $default);
    }
}
