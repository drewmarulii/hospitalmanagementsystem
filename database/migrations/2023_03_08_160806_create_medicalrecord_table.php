<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicalrecord', function (Blueprint $table) {
            $table->string('RECORD_ID', 20)->primary();
            $table->date('MEDREC_DATE')->default(DB::raw('CURRENT_DATE'));
            $table->float('VS_WEIGHT', 5, 2);
            $table->float('VS_HEIGHT', 7, 2);
            $table->float('VS_TEMPERATURE', 4, 1);
            $table->integer('VS_HEARTRATE');
            $table->integer('VS_SYSTOLIC');
            $table->integer('VS_DIASTOLIC');
            $table->integer('VS_RESPIRATION');
            $table->text('MEDREC_DIAGNOSIS');
            $table->text('MEDREC_COMPLAINTS');
            $table->string('APPOINTMENT_ID', 20);
            $table->foreign('APPOINTMENT_ID')->references('APPOINTMENT_ID')->on('appointments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicalrecord');
    }
};
