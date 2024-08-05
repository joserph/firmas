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
      Schema::create('natural_people', function (Blueprint $table) {
         $table->id();
         
         $table->string('tipodocumento');
         $table->string('numerodocumento');
         $table->string('nombres');
         $table->string('apellido1');
         $table->string('apellido2')->nullable();
         $table->date('fecha_nacimiento');
         $table->string('sexo');
         $table->string('nacionalidad');
         $table->string('cdactilar')->nullable();
         $table->string('telfCelular');
         $table->string('eMail');
         $table->string('telfCelular2')->nullable();
         $table->string('eMail2')->nullable();
         $table->string('con_ruc');
         $table->string('ruc_personal')->nullable();
         $table->string('provincia');
         $table->string('ciudad');
         $table->string('direccion');
         $table->string('formato');
         $table->string('vigenciafirma');
         $table->string('token')->nullable();
         

         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('natural_people');
   }
};
