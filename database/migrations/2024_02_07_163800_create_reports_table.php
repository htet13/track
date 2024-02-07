<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('expense')->default(0);
            $table->integer('total_oil')->default(0);
            $table->integer('total_price')->default(0);
            $table->integer('check_cost')->default(0);
            $table->integer('gate_cost')->default(0);
            $table->integer('food_cost')->default(0);
            $table->integer('other_cost')->default(0);
            $table->integer('total')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
