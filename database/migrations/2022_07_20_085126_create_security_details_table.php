<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecurityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security_details', function (Blueprint $table) {



            $table->id();

            //client
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            //agent
            $table->bigInteger('agent_id')->unsigned()->nullable();
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');

            //security type
            $table->bigInteger('security_type_id')->unsigned();

            //franchise
            $table->bigInteger('franchise_id')->unsigned();

            //feedback
            $table->longText('client_briefing')->nullable();
            $table->longText('agent_feedback')->nullable();

            //address
            $table->string('address', 150);
            $table->string('city', 50);

            //datetime stamps
            $table->dateTime('start_date');
            $table->dateTime('planned_end_date');
            $table->dateTime('actual_end_date');

            //hooks to payments in payfast
            $table->string('deposit_reference', 50)->unique('deposit_reference');
            $table->string('final_reference', 50)->unique('final_reference');

            //payment details
            $table->string('currency', 5);
            $table->string('payment_type', 5);
            $table->double('hourly_rate', 8, 2);
            $table->bigInteger('voucher_id')->unsigned()->nullable();
            $table->double('voucher_max', 8, 2)->default(0);
            $table->double('deposit_received', 8, 2)->default(0);
            $table->double('calc_total_hours', 8, 2)->default(0);
            $table->double('calc_total_charge', 8, 2)->default(0);
            $table->double('final_charge', 8, 2)->default(0);
            $table->double('final_received', 8, 2)->default(0);

            //state

            $table->boolean('agent_accepted')->default(0);
            $table->boolean('detail_started')->default(0);
            $table->boolean('detail_ended')->default(0);
            $table->boolean('detail_closed')->default(0);


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
        Schema::dropIfExists('security_details');
    }
}
