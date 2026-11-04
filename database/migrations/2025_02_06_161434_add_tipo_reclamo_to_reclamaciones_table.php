<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('libro_de_reclamaciones', function (Blueprint $table) {
            if (!Schema::hasColumn('libro_de_reclamaciones', 'tipo_reclamo')) {
                $table->enum('tipo_reclamo', ['Reclamación', 'Queja'])->after('telefono');
            }
        });
        

    }

    public function down()
    {
        Schema::table('libro_de_reclamaciones', function (Blueprint $table) {
            $table->dropColumn('tipo_reclamo');
        });
    }
};
