<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheckTopRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'run_id',
        'range_code',
        'Ltop',
        'Htopup',
        'Htopdn',
        'Ptop',
        'Wup',
        'Wdn',
    ];

    protected $casts = [
        'range_code' => 'integer',
        'Ltop' => 'float',
        'Htopup' => 'float',
        'Htopdn' => 'float',
        'Ptop' => 'float',
        'Wup' => 'float',
        'Wdn' => 'float',
    ];

    public function run(): BelongsTo
    {
        return $this->belongsTo(ScheckRun::class, 'run_id');
    }
}

