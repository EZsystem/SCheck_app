<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheck_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('run_id')->constrained('scheck_runs')->onDelete('cascade');

            // 環境・係数・許容値
            $table->integer('Vo')->nullable();
            $table->float('Ke')->nullable();
            $table->float('EB')->nullable();
            $table->float('Eg')->nullable();
            $table->float('Co')->nullable();
            $table->float('phi')->nullable();
            $table->float('wall_tie_stress')->nullable();
            $table->float('wall_tie_stress2')->nullable();
            $table->float('War')->nullable();

            $table->timestamps();

            $table->unique('run_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheck_settings');
    }
};
