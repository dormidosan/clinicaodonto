<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorServicioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'doctor_servicio';

    /**
     * Run the migrations.
     * @table doctor_servicio
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('servicio_id');
            $table->timestamps();

            $table->index(["servicio_id"], 'fk_doctor_servicio_servicios1_idx');

            $table->index(["doctor_id"], 'fk_doctor_servicio_doctores1_idx');


            $table->foreign('doctor_id', 'fk_doctor_servicio_doctores1_idx')
                ->references('id')->on('doctores')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('servicio_id', 'fk_doctor_servicio_servicios1_idx')
                ->references('id')->on('servicios')
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
