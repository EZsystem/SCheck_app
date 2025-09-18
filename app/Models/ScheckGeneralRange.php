<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheckGeneralRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'range_code',
        'S',
        'L',
        'H',
        'A',
        'Pbtm',
        'Vz',
        'QzN',
        'Wup',
        'Wdn',
    ];

    protected $casts = [
        'range_code' => 'integer',
        'S' => 'float',
        'L' => 'float',
        'H' => 'float',
        'A' => 'float',
        'Pbtm' => 'float',
        'Vz' => 'float',
        'QzN' => 'float',
        'Wup' => 'float',
        'Wdn' => 'float',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScheckRun::class, 'run_id');
    }
}

