<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSalaryTable extends Migration
{

    public function up()
    {
        Schema::create('employee_salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('salary',8, 2);
            $table->float('social_insurance', 8, 2);
            $table->bigInteger('employee_id');
            $table->date('salary_date');
            $table->boolean('payment_status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_salary');
    }
}
