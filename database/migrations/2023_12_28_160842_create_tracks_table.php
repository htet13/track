
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
            $table->uuid('from');
            $table->uuid('to');
            $table->Integer('amount')->default(0);
            $table->enum('action_mode',['on','off'])->default('on');
            $table->enum('type',['sale','purchase']);
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();

            $table->foreign('from')->references('id')->on('cities');
            $table->foreign('to')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracks_table');
    }
}
