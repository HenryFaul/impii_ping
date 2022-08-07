<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->integer('max_uses')->default(1);
            $table->integer('uses')->default(0);
            $table->boolean('active')->default(0);
            $table->string('currency', 10)->default('ZAR');
            $table->string('voucher_key', 50);
            $table->unique(['voucher_key']);
            $table->decimal('max_amount', $precision = 8, $scale = 2);
            $table->string('description', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
