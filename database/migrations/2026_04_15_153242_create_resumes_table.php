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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id('resume_id');

            $table->string('resume_title');
            $table->unsignedBigInteger('candidate_id');
             $table->unsignedBigInteger('category_id')->nullable();

            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();

            $table->text('career_objective')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->text('soft_skills')->nullable();
            $table->text('awards')->nullable();

            $table->foreign('candidate_id')->references('candidate_id')->on('candidates')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('job_type_id')->references('job_type_id')->on('job_types');
            $table->foreign('level_id')->references('level_id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
    }
};
