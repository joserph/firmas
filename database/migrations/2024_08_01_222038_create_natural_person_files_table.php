<?php

use App\Models\NaturalPerson;
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
        Schema::create('natural_person_files', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(NaturalPerson::class);
            $table->longText('f_cedulaFront')->charset('binary');
            $table->longText('f_cedulaBack')->charset('binary');
            $table->longText('f_selfie')->charset('binary');
            $table->longText('videoFile')->nullable()->charset('binary');
            $table->longText('f_copiaruc')->nullable()->charset('binary');
            $table->longText('f_adicional1')->nullable()->charset('binary');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('natural_person_files');
    }
};
