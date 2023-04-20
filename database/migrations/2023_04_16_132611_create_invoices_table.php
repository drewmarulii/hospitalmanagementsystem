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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('INVOICE_ID', 20)->primary();
            $table->date('INVOICE_DATE')->useCurrent();
            $table->float('INVOICE_AMOUNT');
            $table->string('INVOICE_STATUS');
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
        Schema::dropIfExists('invoices');
    }
};
