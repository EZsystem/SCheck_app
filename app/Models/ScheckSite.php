<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheckSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'Lg',
        'Bg',
        'Ba',
        'Ha',
    ];

    protected $casts = [
        'Lg' => 'float',
        'Bg' => 'float',
        'Ba' => 'float',
        'Ha' => 'float',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScheckRun::class, 'run_id');
    }
}

