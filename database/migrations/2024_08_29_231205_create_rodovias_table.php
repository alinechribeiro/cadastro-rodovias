<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodoviasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodovias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uf_id')->constrained('ufs')->onDelete('cascade'); // Chave estrangeira para a tabela UFs
            $table->string('rodovia');
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
        Schema::dropIfExists('rodovias');
    }
}
