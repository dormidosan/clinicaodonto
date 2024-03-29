<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'telefonos';

    /**
     * Run the migrations.
     * @table telefonos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('numero', 20)->nullable();
            $table->unsignedInteger('expediente_id');
            $table->timestamps();

            $table->index(["expediente_id"], 'fk_telefonos_expedientes1_idx');


            $table->foreign('expediente_id', 'fk_telefonos_expedientes1_idx')
                ->references('id')->on('expedientes')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
