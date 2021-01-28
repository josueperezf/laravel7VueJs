<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        Schema::create('ubicacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });
        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->string('monto');
            $table->timestamps();
        });
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagen');
            $table->text('descripcion');
            $table->text('habilidades');
            $table->boolean('activa')->default(true);
            $table->foreignId('categoria_id')->constrained()->cascadeOnDelete();
            $table->foreignId('experiencia_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ubicacion_id')->constrained()->cascadeOnDelete();
            $table->foreignId('salario_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacantes');
        Schema::dropIfExists('experiencias');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('ubicacions');
        Schema::dropIfExists('salarios');
    }
}
