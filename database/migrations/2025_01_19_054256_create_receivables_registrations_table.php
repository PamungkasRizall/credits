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
        Schema::create('receivables_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reg_code', 16)->unique();
            $table->integer('number');
            $table->year('year');
            $table->date('date_at');
            $table->smallInteger('tenor');
            $table->double('bill_per_day');
            $table->tinyInteger('status')->comment('0: Pending, 1: In Process, 2: Paid Off')->default(0);
            $table->uuid('consumer_id');
            $table->uuid('product_id');
            $table->double('item_price');
            $table->uuid('sales_id');
            $table->uuid('supervisor_id');
            $table->uuid('wasdit_id');
            $table->uuid('ar_id');
            $table->uuid('collector_id');

            $table->string('contract_code', 26)->nullable()->unique();
            $table->integer('contract_number')->nullable();

            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');

            $table->foreign('sales_id')->references('id')->on('users');
            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->foreign('wasdit_id')->references('id')->on('users');
            $table->foreign('ar_id')->references('id')->on('users');
            $table->foreign('collector_id')->references('id')->on('users');

            $table->unique(['number', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivables_registrations');
    }
};
