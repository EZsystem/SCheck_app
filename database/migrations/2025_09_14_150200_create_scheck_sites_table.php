<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheck_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('run_id')->constrained('scheck_runs')->onDelete('cascade');

            // 現場寸法（地上/空中）
            $table->float('Lg')->nullable();
            $table->float('Bg')->nullable();
            $table->float('Ba')->nullable();
            $table->float('Ha')->nullable();

            $table->timestamps();

            $table->unique('run_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheck_sites');
    }
};

