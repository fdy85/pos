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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(1);   //1 => Active 0 => Inactive
            $table->tinyInteger('is_available')->default(1);     // 0 => Ocupada  1 => Disponible

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('branch_office_id');

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cash_registers');
    }
};
