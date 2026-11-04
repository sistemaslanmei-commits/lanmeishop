<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        // TipoServicio
        Schema::create('tipo_servicio', function (Blueprint $table) {
            $table->id('Id_TipoServicio');
            $table->string('NombreTipoServicio');
            $table->timestamps();
        });

        // Estado
        Schema::create('estado', function (Blueprint $table) {
            $table->id('Id_Estado');
            $table->string('NombreEstado');
            $table->timestamps();
        });

        // Empleado
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('Id_Empleado');
            $table->string('Nombre');
            $table->string('Apellido');
            $table->timestamps();
        });

        // Sede
        Schema::create('sede', function (Blueprint $table) {
            $table->id('Id_Sede');
            $table->string('Distrito');
            $table->string('Ubigeo', 6);
            $table->timestamps();
        });

        // Cliente
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('Id_Cli');
            $table->string('NombreCli');
            $table->timestamps();
        });

        // ClienteSede
        Schema::create('cliente_sede', function (Blueprint $table) {
            $table->id('Id_SedeCli');
            $table->foreignId('Id_Cli')->constrained('cliente','Id_Cli')->onDelete('cascade');
            $table->foreignId('Id_Sede')->constrained('sede', 'Id_Sede')->onDelete('cascade');
            $table->timestamps();
        });

        // Servicio
        Schema::create('servicio', function (Blueprint $table) {
            $table->id('Id_Servicio');
            $table->foreignId('Id_TipoServicio')->constrained('tipo_servicio', 'Id_TipoServicio')->onDelete('cascade');
            $table->date('FechaInicio');
            $table->date('FechaFin')->nullable();
            $table->foreignId('Id_SedeCli')->constrained('cliente_sede', 'Id_SedeCli')->onDelete('cascade');
            $table->foreignId('Id_Empleado')->constrained('empleado', 'Id_Empleado')->onDelete('cascade');
            $table->decimal('PrecioCosto', 10, 2);
            $table->decimal('PrecioVenta', 10, 2);
            $table->decimal('Ganancia', 10, 2)->nullable();
            $table->foreignId('Id_Estado')->constrained('estado', 'Id_Estado')->onDelete('cascade');
            $table->timestamps();
        });

        // Servicio_Vencimiento
        Schema::create('servicio_vencimiento', function (Blueprint $table) {
            $table->id('Id_ServicioVencimiento');
            $table->foreignId('Id_Servicio')->constrained('servicio', 'Id_Servicio')->onDelete('cascade');
            $table->string('NombreServicioVecimiento');
            $table->date('FechaVencimiento');
            $table->timestamps();
        });

        // Servicio_detalle
        Schema::create('servicio_detalle', function (Blueprint $table) {
            $table->id('Id_ServicioDetalle');
            $table->foreignId('Id_Servicio')->constrained('servicio', 'Id_Servicio')->onDelete('cascade');
            $table->text('Problema');
            $table->text('Solución');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicio_detalle');
        Schema::dropIfExists('servicio_vencimiento');
        Schema::dropIfExists('servicio');
        Schema::dropIfExists('cliente_sede');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('sede');
        Schema::dropIfExists('empleado');
        Schema::dropIfExists('estado');
        Schema::dropIfExists('tipo_servicio');
    }

};
