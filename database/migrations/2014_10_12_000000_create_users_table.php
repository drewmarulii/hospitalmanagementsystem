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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userid');
            $table->string('email')->unique();
            $table->string('username', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('level', 5);
            $table->foreign('level')->references('role_id')->on('roles')->onDelete('cascade');

            $table->string('user_pp')->nullable();
            $table->string('user_fname', 50);
            $table->string('user_mname', 50)->nullable();
            $table->string('user_lname', 50);
            $table->string('user_gender', 20);
            $table->string('user_room', 20);
            $table->string('polyid', 20);
            $table->foreign('polyid')->references('poly_id')->on('polyclinic')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
