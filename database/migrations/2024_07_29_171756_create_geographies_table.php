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
        Schema::create('geographies', function (Blueprint $table) {
            $table->id();

            $table->integer('cod_province');
            $table->integer('cod_canton');
            $table->string('name_province');
            $table->string('name_canton');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographies');
    }
};
