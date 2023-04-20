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
        Schema::create('ordermedicine', function (Blueprint $table) {
            $table->string('MED_ORDER_ID', 20)->primary();
            $table->integer('QUANTITY');
            $table->text('INSTRUCTION');
            $table->string('ORD_STATUS')->default('NEW');
            $table->string('MEDRECID', 20);
            $table->foreign('MEDRECID')->references('RECORD_ID')->on('medicalrecord')->onDelete('cascade');
            $table->string('MEDICINE', 20);
            $table->foreign('MEDICINE')->references('MEDICINE_ID')->on('medicine')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordermedicine');
    }
};
