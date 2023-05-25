<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_partials_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->double('withdrawal');
            $table->text('comments');
            
            $table->unsignedBigInteger('cash_register_id');
            $table->unsignedBigInteger('cashout_id');
            $table->unsignedBigInteger('user_id');

            
            $table->foreign('cash_register_id')->references('id')->on('cash_registers');
            $table->foreign('cashout_id')->references('id')->on('cashouts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('cash_partials_withdrawals');
    }
};
