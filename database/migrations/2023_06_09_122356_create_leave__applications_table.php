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
        Schema::create('leave__applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeID');
            $table->date("from");
            $table->date("to");
            $table->string("reason");
            $table->timestamps();

            $table->foreign('employeeID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave__applications');
    }
};
