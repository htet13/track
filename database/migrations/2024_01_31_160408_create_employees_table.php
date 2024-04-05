<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('position');
            $table->enum('status',['new','resign'])->default('new');
            $table->enum('salary_type',['monthly','drive_fee'])->default('monthly');
            $table->date('joined_date');
            $table->date('resign_date')->nullable();
            $table->text('remark')->nullable();
            $table->integer('advance')->default(0);
            $table->softDeletes();
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
