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
        Schema::create('companions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address');
            $table->string('profession', 50);
            $table->string('phone', 15);
            $table->string('relationship', 50);
            $table->unsignedSmallInteger('relationship_id');
            $table->uuid('consumer_id')->nullable();
            $table->timestamps();

            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('relationship_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companions');
    }
};
