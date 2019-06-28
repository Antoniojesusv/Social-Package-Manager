<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSocialpackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_socialpackage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idSocialPackage');
            $table->foreign('idSocialPackage')->references('id')->on('socialpackages')->onDelete('cascade');
            $table->unsignedBigInteger('idEmployee');
            $table->foreign('idEmployee')->references('id')->on('employees')->onDelete('cascade');
            $table->date('startDate');
            $table->date('endDate');
            $table->double('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_socialpackage');
    }
}
