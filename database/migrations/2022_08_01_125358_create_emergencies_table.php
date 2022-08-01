<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {




        Schema::create('emergencies', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('type', 50);
            $table->string('address', 150);
            $table->longText('emergency_details')->nullable();
            $table->longText('admin_comments')->nullable();
            $table->decimal('browser_lat', 10, 7)->default(0);
            $table->decimal('browser_long', 10, 7)->default(0);
            $table->boolean('emergency_closed')->default(0);

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
        Schema::dropIfExists('emergencies');
    }
}
