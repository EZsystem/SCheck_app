<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheck_top_ranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('run_id')->constrained('scheck_runs')->onDelete('cascade');

            // 高さレンジコード（10/20/35/40/50/55/70/100 など）
            $table->unsignedSmallInteger('range_code');

            // 突出部の入力/出力値
            $table->float('Ltop')->nullable();
            $table->float('Htopup')->nullable();
            $table->float('Htopdn')->nullable();
            $table->float('Ptop')->nullable();
            $table->float('Wup')->nullable();
            $table->float('Wdn')->nullable();

            $table->timestamps();

            $table->unique(['run_id', 'range_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheck_top_ranges');
    }
};

