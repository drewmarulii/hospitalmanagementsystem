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
        Schema::create('payment', function (Blueprint $table) {
            $table->string('PAYMENT_ID', 20)->primary();
            $table->float('AMOUNT_PAID');
            $table->string('PAYMENT_PROOF_FILE')->nullable();
            $table->string('INVOICEID', 20);
            $table->foreign('INVOICEID')->references('INVOICE_ID')->on('invoices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
