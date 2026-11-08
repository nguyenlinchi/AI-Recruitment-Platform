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
        Schema::create('career_guide_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('guide_id');
            $table->unsignedBigInteger('tag_id');

            $table->primary(['guide_id', 'tag_id']);

            $table->foreign('guide_id')
                ->references('guide_id')
                ->on('career_guides')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('tag_id')
                ->on('tags')
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
        Schema::dropIfExists('career_guide_tag');
    }
};
