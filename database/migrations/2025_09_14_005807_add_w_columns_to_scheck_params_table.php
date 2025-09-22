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
        Schema::table('scheck_params', function (Blueprint $table) {
            // W上の値（各高さ範囲のA行）
            $table->float('Wup10')->nullable();
            $table->float('Wup20')->nullable();
            $table->float('Wup35')->nullable();
            $table->float('Wup40')->nullable();
            $table->float('Wup50')->nullable();
            $table->float('Wup55')->nullable();
            $table->float('Wup70')->nullable();
            $table->float('Wup100')->nullable();

            // W下の値（各高さ範囲のB行）
            $table->float('Wdn10')->nullable();
            $table->float('Wdn20')->nullable();
            $table->float('Wdn35')->nullable();
            $table->float('Wdn40')->nullable();
            $table->float('Wdn50')->nullable();
            $table->float('Wdn55')->nullable();
            $table->float('Wdn70')->nullable();
            $table->float('Wdn100')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheck_params', function (Blueprint $table) {
            // W上の値を削除
            $table->dropColumn([
                'Wup10',
                'Wup20',
                'Wup35',
                'Wup40',
                'Wup50',
                'Wup55',
                'Wup70',
                'Wup100'
            ]);

            // W下の値を削除
            $table->dropColumn([
                'Wdn10',
                'Wdn20',
                'Wdn35',
                'Wdn40',
                'Wdn50',
                'Wdn55',
                'Wdn70',
                'Wdn100'
            ]);
        });
    }
};
