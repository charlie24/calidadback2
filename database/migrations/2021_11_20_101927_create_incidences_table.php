<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('incidence_category_id');
            $table->unsignedBigInteger('incidence_status_id');
            $table->unsignedBigInteger('department_id');
            $table->dateTime('date');
            $table->string('title');
            $table->text('description');
            $table->string('contact');
            $table->integer('calification')->default(0);

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('incidence_category_id')->references('id')->on('incidence_categories');
            $table->foreign('incidence_status_id')->references('id')->on('incidence_states');
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
        Schema::dropIfExists('incidences');
    }
}
