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
        Schema::create('medicine', function (Blueprint $table) {
            $table->string('MEDICINE_ID', 20)->primary();
            $table->string('MEDICINE_NAME', 100);
            $table->string('MED_PACKTYPE', 100);
            $table->integer('QTY_PERPACK');
            $table->string('QTY_UNIT');
            $table->float('MED_PRICE');
            $table->integer('MED_INSTOCK');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine');
    }
};
