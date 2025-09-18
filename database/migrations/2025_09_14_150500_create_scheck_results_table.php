<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheck_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('run_id')->constrained('scheck_runs')->onDelete('cascade');

            // 実行全体の派生値
            $table->float('r')->nullable();
            $table->float('Fbtm')->nullable();
            $table->float('Ftop')->nullable();
            $table->float('C1')->nullable();
            $table->float('C2')->nullable();
            $table->float('Rg')->nullable();
            $table->float('Ra')->nullable();

            $table->json('calculation_meta')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->unique('run_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheck_results');
    }
};

