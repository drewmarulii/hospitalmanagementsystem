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
        Schema::create('treatmentlist', function (Blueprint $table) {
            $table->string('TREATMENT_ID', 20)->primary();
            $table->string('TREATMENT_NAME', 50);
            $table->float('TREATMENT_PRICE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatmentlist');
    }
};
