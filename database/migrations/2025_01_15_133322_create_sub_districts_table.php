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
        Schema::create('sub_districts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('province_code');
            $table->bigInteger('city_code');
            $table->bigInteger('district_code');
            $table->bigInteger('sub_district_code')->unique();
            $table->string('province_name');
            $table->string('city_name');
            $table->string('district_name');
            $table->string('sub_district_name');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_districts');
    }
};
