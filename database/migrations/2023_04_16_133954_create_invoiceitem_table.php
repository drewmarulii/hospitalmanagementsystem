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
        Schema::create('invoiceitem', function (Blueprint $table) {
            $table->string('INVITEM_ID', 20)->primary();
            $table->string('INVOICEID', 20)->nullable();
            $table->foreign('INVOICEID')->references('INVOICE_ID')->on('invoices')->onDelete('cascade');
            $table->string('ITEMID', 20);
            $table->foreign('ITEMID')->references('ITEM_ID')->on('item')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoiceitem');
    }
};
