<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scheck_params', function (Blueprint $table) {
            $table->id();

            // 0〜100はinteger
            $table->integer('Vo')->nullable();

            // それ以外はfloat
            $table->float('S10')->nullable();
            $table->float('S20')->nullable();
            $table->float('S35')->nullable();
            $table->float('S40')->nullable();
            $table->float('S50')->nullable();
            $table->float('S55')->nullable();
            $table->float('S70')->nullable();
            $table->float('S100')->nullable();

            $table->float('Ke')->nullable();
            $table->float('EB')->nullable();
            $table->float('Eg')->nullable();

            $table->float('Rg')->nullable();
            $table->float('Ra')->nullable();

            $table->float('Lg')->nullable();
            $table->float('Bg')->nullable();
            $table->float('Ba')->nullable();
            $table->float('Ha')->nullable();

            $table->float('Co')->nullable();
            $table->float('phi')->nullable();
            $table->float('Vz')->nullable();
            $table->float('QzN')->nullable();
            $table->float('C')->nullable();
            $table->float('C1')->nullable();
            $table->float('C2')->nullable();
            $table->float('Fbtm')->nullable();
            $table->float('Ftop')->nullable();
            $table->float('wall_tie_stress')->nullable();

            $table->float('L10')->nullable();
            $table->float('L20')->nullable();
            $table->float('L35')->nullable();
            $table->float('L40')->nullable();
            $table->float('L50')->nullable();
            $table->float('L55')->nullable();
            $table->float('L70')->nullable();
            $table->float('L100')->nullable();

            $table->float('H10')->nullable();
            $table->float('H20')->nullable();
            $table->float('H35')->nullable();
            $table->float('H40')->nullable();
            $table->float('H50')->nullable();
            $table->float('H55')->nullable();
            $table->float('H70')->nullable();
            $table->float('H100')->nullable();

            $table->float('A10')->nullable();
            $table->float('A20')->nullable();
            $table->float('A35')->nullable();
            $table->float('A40')->nullable();
            $table->float('A50')->nullable();
            $table->float('A55')->nullable();
            $table->float('A70')->nullable();
            $table->float('A100')->nullable();

            $table->float('Ltop')->nullable();
            $table->float('htop1')->nullable();
            $table->float('htop2')->nullable();
            $table->float('atop1')->nullable();
            $table->float('atop2')->nullable();

            $table->float('War')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheck_params');
    }
};

