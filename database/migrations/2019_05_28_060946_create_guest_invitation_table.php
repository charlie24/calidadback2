<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_invitation', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('invitation_id');
            
            $table->primary(['guest_id','invitation_id']);

            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('invitation_id')->references('id')->on('invitations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_invitation');
    }
}
