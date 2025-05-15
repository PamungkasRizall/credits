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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->index()->unique();
            $table->string('type', 100);
            $table->double('price');
            $table->text('notes')->nullable();
            $table->tinyInteger('active')->comment('0: Not Active, 1: Active')->default(1);
            $table->unsignedSmallInteger(column: 'merk_id');
            $table->unsignedSmallInteger('unit_id');

            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('merk_id')->references('id')->on('categories');
            $table->foreign('unit_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
