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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->double(column: 'bill')->nullable();
            $table->date('date_at');
            $table->uuid('receivables_registration_id');

            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();

            $table->foreign('receivables_registration_id')->references('id')->on('receivables_registrations');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unique(['number', 'receivables_registration_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
