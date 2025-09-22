<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('scheck_params');
    }

    public function down(): void
    {
        Schema::create('scheck_params', function (Blueprint $table) {
            $table->id();
            $table->integer('Vo')->nullable();

            foreach ([10, 20, 35, 40, 50, 55, 70, 100] as $code) {
                $table->float("S{$code}")->nullable();
                $table->float("L{$code}")->nullable();
                $table->float("H{$code}")->nullable();
                $table->float("A{$code}")->nullable();
                $table->float("Vz{$code}")->nullable();
                $table->float("QzN{$code}")->nullable();
                $table->float("Pbtm{$code}")->nullable();
                $table->float("Wup{$code}")->nullable();
                $table->float("Wdn{$code}")->nullable();
            }

            $table->float('Ke')->nullable();
            $table->float('EB')->nullable();
            $table->float('Eg')->nullable();
            $table->float('Co')->nullable();
            $table->float('phi')->nullable();
            $table->float('wall_tie_stress')->nullable();
            $table->float('War')->nullable();
            $table->float('Ltop')->nullable();
            $table->float('htop1')->nullable();
            $table->float('htop2')->nullable();
            $table->float('atop1')->nullable();
            $table->float('atop2')->nullable();
            $table->float('r')->nullable();
            $table->float('Fbtm')->nullable();
            $table->float('Ftop')->nullable();
            $table->float('C1')->nullable();
            $table->float('C2')->nullable();
            $table->float('Rg')->nullable();
            $table->float('Ra')->nullable();

            $table->timestamps();
        });
    }
};

