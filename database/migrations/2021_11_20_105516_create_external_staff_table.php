<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('incidence_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('description');
            $table->string('contact');

            $table->foreign('incidence_id')->references('id')->on('incidences');

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
        Schema::dropIfExists('external_staff');
    }
}
