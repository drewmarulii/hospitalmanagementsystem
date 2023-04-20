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
        Schema::table('treceived', function (Blueprint $table) {
            $table->string('INVOICEID', 20)->nullable();
            $table->foreign('INVOICEID')->references('INVOICE_ID')->on('invoices')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treceived', function (Blueprint $table) {
            $table->dropColumn('INVOICEID', 20);
        });
    }
};
