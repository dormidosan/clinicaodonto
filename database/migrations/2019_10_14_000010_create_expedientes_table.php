<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'expedientes';

    /**
     * Run the migrations.
     * @table expedientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('persona_id');
            $table->unsignedInteger('tipo_sanguineo_id');
            $table->string('direccion', 60)->nullable();
            $table->string('email', 45)->nullable();
            $table->timestamps();

            $table->index(["tipo_sanguineo_id"], 'fk_expedientes_tipo_sanguineos1_idx');

            $table->index(["persona_id"], 'fk_expedientes_personas1_idx');


            $table->foreign('tipo_sanguineo_id', 'fk_expedientes_tipo_sanguineos1_idx')
                ->references('id')->on('tipo_sanguineos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('persona_id', 'fk_expedientes_personas1_idx')
                ->references('id')->on('personas')
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
