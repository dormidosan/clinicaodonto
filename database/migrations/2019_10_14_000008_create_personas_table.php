<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'personas';

    /**
     * Run the migrations.
     * @table personas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('primer_nombre', 15)->nullable();
            $table->string('segundo_nombre', 15)->nullable();
            $table->string('primer_apellido', 15)->nullable();
            $table->string('segundo_apellido', 15)->nullable();
            $table->unsignedInteger('sexo_id');
            $table->date('fecha_nac')->nullable();
            $table->timestamps();

            $table->index(["sexo_id"], 'fk_personas_sexos1_idx');


            $table->foreign('sexo_id', 'fk_personas_sexos1_idx')
                ->references('id')->on('sexos')
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
