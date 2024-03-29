<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlergiaExpedienteTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'alergia_expediente';

    /**
     * Run the migrations.
     * @table alergia_expediente
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('expediente_id');
            $table->unsignedInteger('alergia_id');
            $table->timestamps();

            $table->index(["alergia_id"], 'fk_alergia_expediente_alergias1_idx');

            $table->index(["expediente_id"], 'fk_alergia_expediente_expedientes1_idx');


            $table->foreign('expediente_id', 'fk_alergia_expediente_expedientes1_idx')
                ->references('id')->on('expedientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('alergia_id', 'fk_alergia_expediente_alergias1_idx')
                ->references('id')->on('alergias')
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
