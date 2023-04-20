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
        Schema::create('treceived', function (Blueprint $table) {
            $table->string('TRECEIVED_ID', 20)->primary();
            $table->string('TREATMENT_ID', 20);
            $table->foreign('TREATMENT_ID')->references('TREATMENT_ID')->on('treatmentlist')->onDelete('cascade');
            $table->string('MEDRECID', 20);
            $table->foreign('MEDRECID')->references('RECORD_ID')->on('medicalrecord')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treceived');
    }
};
