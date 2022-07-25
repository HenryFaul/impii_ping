<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('detail_id')->unsigned();
            $table->foreign('detail_id')->references('id')->on('security_details')->onDelete('cascade');
            $table->string('reference', 50);
            $table->string('status', 50);
            $table->string('type', 50);
            $table->double('value', 8, 2)->default(0);
            $table->boolean('is_updated')->default(0);
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
        Schema::dropIfExists('payment_histories');
    }
}
