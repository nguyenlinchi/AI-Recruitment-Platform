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
        Schema::create('career_guides', function (Blueprint $table) {
            $table->id('guide_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('thumbnail')->nullable();

            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('category_id');

            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->foreign('account_id')->references('account_id')->on('accounts');
            $table->foreign('category_id')->references('category_id')->on('career_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_guides');
    }
};
