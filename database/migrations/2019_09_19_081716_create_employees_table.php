<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(0);
            $table->string('name');
            $table->string('surname');
            $table->string('id_card');
            $table->date('birthday');
            $table->string('address');
            $table->string('tel');
            $table->string('email');
            $table->string('position');
            $table->string('social_insurance_no');
            $table->string('account_no');
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
        Schema::dropIfExists('employees');
    }
}
