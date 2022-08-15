<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('agent_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('agency_id')->unsigned()->default(1);
            $table->foreign('agency_id')->references('id')->on('agencies');
            $table->string('tag_line', 300)->nullable();
            $table->longText('accreditations')->nullable();
            $table->longText('about_summary')->nullable();
            $table->boolean('is_personal_protection')->default(1);
            $table->boolean('is_cpo_protection')->default(0);
            $table->boolean('is_available')->default(0);
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
        Schema::dropIfExists('agent_details');
    }


}
