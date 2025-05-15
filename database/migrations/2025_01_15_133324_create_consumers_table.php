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
        Schema::create('consumers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('nik', 16)->unique();
            $table->date('date_of_birth');
            $table->tinyInteger('gender')->comment('0: Pria; 1: Wanita');
            $table->string('phone', 15)->unique();
            $table->string('home_address');
            $table->string('business_type');
            $table->string('business_address');
            $table->string('business_status');
            $table->bigInteger('sub_district_code');
            $table->float('radius');

            $table->timestamp('created_at', 0)->nullable();
            $table->uuid('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');

            $table->foreign('sub_district_code')->references('sub_district_code')->on('sub_districts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumers');
    }
};
