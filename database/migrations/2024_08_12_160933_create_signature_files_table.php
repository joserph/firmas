<?php

use App\Models\Signature;
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
        Schema::create('signature_files', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Signature::class);
            $table->string('tipo_solicitud');
            $table->longText('f_cedulaFront')->charset('binary'); // NP, RP, ME
            $table->longText('f_cedulaBack')->charset('binary'); // NP, RP, ME
            $table->longText('f_selfie')->charset('binary'); // NP, RP, ME
            $table->longText('videoFile')->nullable()->charset('binary'); // NP f_adicional1, RP, ME
            $table->longText('f_copiaruc')->nullable()->charset('binary'); // NP, RP, ME
            $table->longText('f_adicional1')->nullable()->charset('binary');
            $table->longText('f_adicional2')->nullable()->charset('binary'); // NP, RP, ME
            $table->longText('f_adicional3')->nullable()->charset('binary'); // NP, RP, ME
            $table->longText('f_adicional4')->nullable()->charset('binary'); // NP, RP, ME
            $table->longText('f_constitucion')->nullable()->charset('binary'); // RP, ME
            $table->longText('f_nombramiento')->nullable()->charset('binary'); // RP, ME
            $table->longText('f_nombramiento2')->nullable()->charset('binary'); // RP, ME
            $table->longText('f_documentoRL')->nullable()->charset('binary'); // ME
            $table->longText('f_autreprelegal')->nullable()->charset('binary'); // ME

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature_files');
    }
};
