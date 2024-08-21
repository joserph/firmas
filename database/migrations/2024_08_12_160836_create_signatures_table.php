<?php

use App\Models\User;
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
      Schema::create('signatures', function (Blueprint $table) {
         $table->id();

         $table->dateTime('creacion');
         $table->string('tipo_solicitud');
         $table->string('tipodocumento');
         $table->string('numerodocumento');
         $table->string('nombres');
         $table->string('apellido1')->nullable(); //?
         $table->string('apellido2')->nullable(); //?
         $table->date('fecha_nacimiento')->nullable(); //?
         $table->string('sexo')->nullable(); //?
         $table->string('nacionalidad')->nullable(); //?
         $table->string('cdactilar')->nullable(); //?
         $table->string('telfCelular')->nullable(); //?
         $table->string('eMail')->nullable(); //?
         $table->string('telfCelular2')->nullable(); //?
         $table->string('eMail2')->nullable();
         $table->string('con_ruc')->nullable(); //?
         $table->string('ruc_personal')->nullable(); //?
         $table->string('provincia')->nullable(); //?
         $table->string('ciudad')->nullable(); //?
         $table->string('direccion')->nullable(); //?
         $table->string('formato');
         $table->string('vigenciafirma');
         $table->string('token')->nullable();
         $table->string('ruc')->nullable();
         $table->string('empresa')->nullable();
         $table->string('cargo')->nullable(); //?
         $table->string('unidad')->nullable();
         $table->string('tipodocumentoRL')->nullable();
         $table->string('numerodocumentoRL')->nullable();
         $table->string('nombresRL')->nullable();
         $table->string('apellido1RL')->nullable();
         $table->string('apellido2RL')->nullable();
         $table->dateTime('aprobacion')->nullable();
         $table->string('estado');
         $table->string('datos')->nullable();
         $table->string('documentos')->nullable();
         $table->foreignIdFor(User::class);

         $table->timestamps();
      });
   }

    /**
     * Reverse the migrations.
     */
   public function down(): void
   {
      Schema::dropIfExists('signatures');
   }
};
