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
        Schema::create('cashouts', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->double('cash_start');
            $table->double('total')->default(0.0);
            $table->string('comments')->nullable();
            $table->tinyInteger('status')->default(0);  //0 => Abierto 1 => Cerrado

            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cash_register_id');
            $table->unsignedBigInteger('branch_office_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cash_register_id')->references('id')->on('cash_registers');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
            
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
        Schema::dropIfExists('cashouts');
    }
};
