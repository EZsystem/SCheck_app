<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheckParam extends Model
{
    use HasFactory;

    protected $table = 'scheck_params';

    protected $fillable = [
        'Vo',
        'S10','S20','S35','S40','S50','S55','S70','S100',
        'Ke','EB','Eg','Rg','Ra','Lg','Bg','Ba','Ha',
        'Co','phi','Vz','QzN','C','C1','C2','Fbtm','Ftop','wall_tie_stress',
        'L10','L20','L35','L40','L50','L55','L70','L100',
        'H10','H20','H35','H40','H50','H55','H70','H100',
        'A10','A20','A35','A40','A50','A55','A70','A100',
        'Ltop','htop1','htop2','atop1','atop2',
        'War',
    ];
}

