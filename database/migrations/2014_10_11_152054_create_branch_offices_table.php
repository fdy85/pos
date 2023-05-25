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
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('address');
            $table->string('folder_name')->nullable();
            $table->string('phone', 15);
            $table->string('phone2', 15)->nullable();
            $table->tinyInteger('status')->default(1);
            
            //$table->unsignedBigInteger('modified_by');
            $table->unsignedBigInteger('company_id');

            //$table->foreign('modified_by')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');

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
        Schema::dropIfExists('branch_offices');
    }
};
