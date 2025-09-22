<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheckSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'Vo',
        'Ke',
        'EB',
        'Eg',
        'Co',
        'phi',
        'wall_tie_stress',
        'wall_tie_stress2',
        'War',
    ];

    protected $casts = [
        'Vo' => 'integer',
        'Ke' => 'float',
        'EB' => 'float',
        'Eg' => 'float',
        'Co' => 'float',
        'phi' => 'float',
        'wall_tie_stress' => 'float',
        'wall_tie_stress2' => 'float',
        'War' => 'float',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScheckRun::class, 'run_id');
    }
}
