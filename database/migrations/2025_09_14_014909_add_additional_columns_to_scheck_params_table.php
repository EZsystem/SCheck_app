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
            // Ltop系列
            $table->float('Ltop10')->nullable();
            $table->float('Ltop20')->nullable();
            $table->float('Ltop35')->nullable();
            $table->float('Ltop40')->nullable();
            $table->float('Ltop50')->nullable();
            $table->float('Ltop55')->nullable();
            $table->float('Ltop70')->nullable();
            $table->float('Ltop100')->nullable();

            // Htopup系列
            $table->float('Htopup10')->nullable();
            $table->float('Htopup20')->nullable();
            $table->float('Htopup35')->nullable();
            $table->float('Htopup40')->nullable();
            $table->float('Htopup50')->nullable();
            $table->float('Htopup55')->nullable();
            $table->float('Htopup70')->nullable();
            $table->float('Htopup100')->nullable();

            // Htopdn系列
            $table->float('Htopdn10')->nullable();
            $table->float('Htopdn20')->nullable();
            $table->float('Htopdn35')->nullable();
            $table->float('Htopdn40')->nullable();
            $table->float('Htopdn50')->nullable();
            $table->float('Htopdn55')->nullable();
            $table->float('Htopdn70')->nullable();
            $table->float('Htopdn100')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheck_params', function (Blueprint $table) {
            // Ltop系列を削除
            $table->dropColumn([
                'Ltop10',
                'Ltop20',
                'Ltop35',
                'Ltop40',
                'Ltop50',
                'Ltop55',
                'Ltop70',
                'Ltop100'
            ]);

            // Htopup系列を削除
            $table->dropColumn([
                'Htopup10',
                'Htopup20',
                'Htopup35',
                'Htopup40',
                'Htopup50',
                'Htopup55',
                'Htopup70',
                'Htopup100'
            ]);

            // Htopdn系列を削除
            $table->dropColumn([
                'Htopdn10',
                'Htopdn20',
                'Htopdn35',
                'Htopdn40',
                'Htopdn50',
                'Htopdn55',
                'Htopdn70',
                'Htopdn100'
            ]);
        });
    }
};
