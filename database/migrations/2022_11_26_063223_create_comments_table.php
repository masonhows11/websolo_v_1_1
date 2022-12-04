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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onDelete('cascade');
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')
                ->on('articles')
                ->references('id')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sample_id')->nullable();
            $table->foreign('sample_id')
                ->on('samples')
                ->references('id')
                ->onDelete('cascade');
            $table->unsignedBigInteger('training_id')->nullable();
            $table->foreign('training_id')
                ->on('trainings')
                ->references('id');
            $table->text('body');
            $table->tinyInteger('approved')->default(false);
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
        Schema::dropIfExists('comments');
    }
};
