
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->enum('type', ['tachileik', 'other'])->default('other');
            $table->uuid('car_no_id');
            $table->integer('expense')->default(0);
            $table->uuid('issuer_id');
            $table->uuid('driver_id');
            $table->uuid('spare_id');
            $table->enum('drive_fee', ['paid', 'unpaid'])->default('unpaid');
            $table->integer('check_cost')->default(0);
            $table->integer('gate_cost')->default(0);
            $table->integer('food_cost')->default(0);
            $table->integer('total')->default(0);
            $table->text('remark')->nullable();
            $table->timestamps();

            $table->foreign('car_no_id')->references('id')->on('car_nos');
            $table->foreign('issuer_id')->references('id')->on('issuers');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('spare_id')->references('id')->on('spares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
