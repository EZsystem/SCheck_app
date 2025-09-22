<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheckResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'r',
        'Fbtm',
        'Ftop',
        'C1',
        'C2',
        'Rg',
        'Ra',
        'calculation_meta',
        'completed_at',
    ];

    protected $casts = [
        'r' => 'float',
        'Fbtm' => 'float',
        'Ftop' => 'float',
        'C1' => 'float',
        'C2' => 'float',
        'Rg' => 'float',
        'Ra' => 'float',
        'calculation_meta' => 'array',
        'completed_at' => 'datetime',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScheckRun::class, 'run_id');
    }
}

