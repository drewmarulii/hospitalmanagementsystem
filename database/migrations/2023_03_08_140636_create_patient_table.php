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
        Schema::create('patient', function (Blueprint $table) {
            $table->string('PATIENT_ID', 20)->primary();
            $table->string('PAT_FNAME', 50);
            $table->string('PAT_MNAME', 50)->nullable();
            $table->string('PAT_LNAME', 50);
            $table->string('PAT_RELIGION', 20);
            $table->string('PAT_CITIZEN_ID', 50);
            $table->string('PAT_GENDER', 20);
            $table->string('PAT_POB', 30);
            $table->date('PAT_DOB');
            $table->string('PAT_OCCUPATION', 20);
            $table->bigInteger('PAT_PHONENUMBER');
            $table->string('PAT_EMAIL', 50);
            $table->string('PAT_MARITALSTAT', 20);
            $table->string('PAT_ADDRESS', 200);
            $table->string('PAT_CITY', 50);
            $table->string('PAT_PROVINCE', 50);
            $table->string('PAT_ZIPCODE', 50);
            $table->string('PAT_COUNTRY', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
