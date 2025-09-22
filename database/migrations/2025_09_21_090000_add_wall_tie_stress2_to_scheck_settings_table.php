<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('scheck_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('scheck_settings', 'wall_tie_stress2')) {
                $table->float('wall_tie_stress2')->nullable()->after('wall_tie_stress');
            }
        });
    }

    public function down(): void
    {
        Schema::table('scheck_settings', function (Blueprint $table) {
            if (Schema::hasColumn('scheck_settings', 'wall_tie_stress2')) {
                $table->dropColumn('wall_tie_stress2');
            }
        });
    }
};

