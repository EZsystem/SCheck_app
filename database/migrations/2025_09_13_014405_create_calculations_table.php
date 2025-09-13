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
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable(); // 計算名
            $table->enum('status', ['draft', 'completed', 'failed'])->default('draft');

            // 環境条件データ（JSON形式で拡張可能）
            $table->json('environment_data')->nullable();

            // 現場条件データ（JSON形式で拡張可能）
            $table->json('site_data')->nullable();

            // 計算結果データ（JSON形式で拡張可能）
            $table->json('calculation_results')->nullable();

            // 判定結果
            $table->boolean('is_safe')->nullable();
            $table->text('safety_notes')->nullable();

            // 完了日時
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
