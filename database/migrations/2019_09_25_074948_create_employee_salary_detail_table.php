<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSalaryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('payment_status')->default(0);
            $table->Increments('employee_id');
            $table->Increments('folder_id');
            $table->float('salary', 8,2);
            $table->float('social_insurance', 8,2);
            $table->string('rate');
            $table->time('rate_time');
            $table->string('sum_ot');
            $table->string('note');
            $table->string('total');
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
        Schema::dropIfExists('employee_salary_detail');
    }
}
