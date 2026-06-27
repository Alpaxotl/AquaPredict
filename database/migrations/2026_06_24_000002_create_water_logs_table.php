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
        Schema::create('water_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pond_id')->constrained()->onDelete('cascade');
            $table->decimal('ph', 4, 2);
            $table->decimal('temperature', 5, 2);
            $table->decimal('dissolved_oxygen', 5, 2);
            $table->enum('status', ['Optimal', 'Atensi', 'Kritis'])->default('Optimal');
            $table->text('recommendation')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_logs');
    }
};
