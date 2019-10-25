<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pagos';

    /**
     * Run the migrations.
     * @table pagos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('expedientes_id');
            $table->unsignedInteger('procedimiento_id');
            $table->date('fecha')->nullable();
            $table->float('monto')->nullable();
            $table->timestamps();

            $table->index(["procedimiento_id"], 'fk_pagos_procedimientos1_idx');

            $table->index(["expedientes_id"], 'fk_pagos_expedientes1_idx');


            $table->foreign('procedimiento_id', 'fk_pagos_procedimientos1_idx')
                ->references('id')->on('procedimientos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('expedientes_id', 'fk_pagos_expedientes1_idx')
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
