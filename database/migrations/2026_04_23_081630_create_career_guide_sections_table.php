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
        Schema::create('career_guide_sections', function (Blueprint $table) {
            $table->id('section_id');
            $table->unsignedBigInteger('guide_id');

            $table->string('title');
            $table->text('content');
            $table->integer('sort_order')->default(1);

            $table->timestamps();

            $table->foreign('guide_id')
                ->references('guide_id')
                ->on('career_guides')
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
        Schema::dropIfExists('career_guide_sections');
    }
};
