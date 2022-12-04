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
        Schema::create('back_end_sample', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sample_id')->nullable();
            $table->foreign('sample_id')->references('id')
                ->on('samples')->onDelete('cascade');

            $table->unsignedBigInteger('back_end_id')->nullable();
            $table->foreign('back_end_id')->references('id')
                ->on('back_ends')->onDelete('cascade');
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
        Schema::dropIfExists('back_end_sample');
    }
};
