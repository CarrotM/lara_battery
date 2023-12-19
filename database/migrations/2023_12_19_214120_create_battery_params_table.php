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
        Schema::create('battery_params', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('battery_id');
            $table->bigInteger('param_id');
            $table->string('value');
            $table->boolean('block')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_params');
    }
};
