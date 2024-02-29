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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            //Añadimos más elementos
            $table -> foreignId('user_id')->constrained()->onDelete('cascade');      //Si eliminamos un usario se eliminarán en cascada todos los listings que hayamos creado con él (o que estén asociados a él)
            $table -> string('title');
            $table -> string('logo')->nullable();
            $table -> string('tags');
            $table -> string('company');
            $table -> string('location');
            $table -> string('email');
            $table -> string('website');
            $table -> longText('description');  //Como la descripción tiene más texto vamos a usar longText en lugar de string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
