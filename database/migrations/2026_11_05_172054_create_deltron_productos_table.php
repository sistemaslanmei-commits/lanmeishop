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
        Schema::create('deltron_productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_costo_usd', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('imagen')->nullable();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->string('marca')->nullable();
            $table->text('especificaciones_html')->nullable();
            $table->string('enlace')->nullable();
            $table->string('enlaceVea')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deltron_productos');
    }
};
