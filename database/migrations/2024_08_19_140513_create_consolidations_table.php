<?php

use App\Models\Partner;
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
        Schema::create('consolidations', function (Blueprint $table) {
            $table->id();

            $table->dateTime('creacion_signature')->nullable();
            $table->foreignIdFor(Signature::class);
            $table->foreignIdFor(Partner::class)->nullable();
            $table->decimal('penalidad')->nullable();
            $table->decimal('monto_pagado')->nullable();
            $table->decimal('monto_uanataca')->nullable();
            $table->decimal('ganancia')->storedAs('(penalidad + monto_pagado) - monto_uanataca')->nullable();
            $table->string('saldo')->nullable();
            $table->string('consolidado_banco')->nullable();
            $table->string('estado_pago')->nullable();
            $table->boolean('re_verificado')->nullable();
            $table->string('banco')->nullable();
            $table->string('ref_banco')->nullable();
            $table->string('ref_deposito')->nullable();
            $table->string('modo_pago')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('nota')->nullable();
            $table->boolean('en_uanataca')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consolidations');
    }
};
