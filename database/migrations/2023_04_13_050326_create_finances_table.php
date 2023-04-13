<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('finances', function (Blueprint $table) {

            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name', 50);
            $table->date('period')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('category', ['otros', 'alimentacion', 'vivienda', 'transporte', 'comunicaciones', 'ocio', 'salud', 'educación', 'ahorro'])->nullable();
            $table->decimal('amount', 7, 2);
            $table->boolean('constant')->default(false);
            $table->boolean('is_income')->default(false);
            $table->boolean('compute_household')->default(true);
            $table->foreignId('id_household')->nullable()->constrained('households')->nullOnDelete();
            $table->unique(['id_user', 'name', 'period']);
            $table->index(['id_user', 'period']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
