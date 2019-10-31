<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cliente', function (Blueprint $table) {
                         
            $table->engine = 'InnoDB';                    
            $table->charset = 'utf8';                     
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            /**/
            $table->string('nombre', 50);
            $table->string('apellidos', 100);
            $table->date('fecha_nacimiento');
            $table->string('clave', 100);
            $table->string('correo_electronico', 100)->unique();
            $table->integer('telefono')->nullable($value = true);
            $table->string('direccion', 150)->nullable($value = true);
            $table->string('estado_civil', 20)->nullable($value = true);
            $table->integer('sueldo_anual')->nullable($value = true);
            /**/
            $table->ipAddress('ip')->nullable($value = true);
            /**/
            $table->timestamps();                         
            $table->softDeletes();     
            
            $table->unique(['nombre', 'apellidos','fecha_nacimiento']);
    
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
