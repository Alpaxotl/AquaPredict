<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('water_logs', function (Blueprint $table) {
            // 11 parameter tambahan agar sesuai dengan 14 fitur yang
            // dibutuhkan model Random Forest (sebelumnya hanya 3: ph, temperature, dissolved_oxygen)
            $table->decimal('turbidity', 6, 2)->after('dissolved_oxygen');
            $table->decimal('bod', 5, 2)->after('turbidity');
            $table->decimal('co2', 5, 2)->after('bod');
            $table->decimal('alkalinity', 6, 2)->after('co2');
            $table->decimal('hardness', 6, 2)->after('alkalinity');
            $table->decimal('calcium', 6, 2)->after('hardness');
            $table->decimal('ammonia', 6, 3)->after('calcium');
            $table->decimal('nitrite', 6, 3)->after('ammonia');
            $table->decimal('phosphorus', 6, 3)->after('nitrite');
            $table->decimal('h2s', 6, 3)->after('phosphorus');
            $table->decimal('plankton', 10, 2)->after('h2s');
        });
    }

    public function down(): void
    {
        Schema::table('water_logs', function (Blueprint $table) {
            $table->dropColumn([
                'turbidity', 'bod', 'co2', 'alkalinity', 'hardness',
                'calcium', 'ammonia', 'nitrite', 'phosphorus', 'h2s', 'plankton',
            ]);
        });
    }
};
