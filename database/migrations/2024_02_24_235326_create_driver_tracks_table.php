<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_tracks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('track_id');
            $table->uuid('driver_id')->nullable();
            $table->integer('fee')->default(0);
            $table->enum('is_paid', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('track_id')
                ->references('id')
                ->on('tracks')
                ->onDelete('cascade');
            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_tracks');
    }
}
