<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmasTable extends Migration
{
    public function up()
    {
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('link_aula'); 
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->timestamps();
        }); 
    }

    public function down()
    {
        Schema::dropIfExists('turmas');
    }
}
