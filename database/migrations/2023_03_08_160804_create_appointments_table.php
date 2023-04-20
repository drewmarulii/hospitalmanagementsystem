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
        Schema::create('appointments', function (Blueprint $table) {
            $table->string('APPOINTMENT_ID', 20)->primary()->unique();
            $table->date('APP_DATE');
            $table->string('APPOINTMENT_STATUS', 50)->default('NEW');
            $table->bigInteger('DOCTOR_ID')->unsigned();
            $table->foreign('DOCTOR_ID')->references('userid')->on('users')->onDelete('cascade');
            $table->string('PATIENTID', 20);
            $table->foreign('PATIENTID')->references('PATIENT_ID')->on('patient')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
