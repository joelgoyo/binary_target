<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->boolean('status', [0, 1])->default(0)->comment('0 - Abierto, 1 - Cerrado, 2');
            $table->boolean('priority', [0, 1, 2])->default(0)->comment('0 - Alto, 1 - Medio, 2 - bajo');
            $table->longtext('issue');
            // $table->longtext('note_admin')->nullable();
            $table->longtext('note');
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
        Schema::dropIfExists('tickets');
    }
}
