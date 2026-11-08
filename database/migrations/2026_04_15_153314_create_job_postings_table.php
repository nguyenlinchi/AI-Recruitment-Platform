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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id('job_id');

            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->unsignedBigInteger('salary_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();

            $table->string('job_title');
            $table->string('workplace')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('gender_requirement')->nullable();

            $table->text('job_description')->nullable();
            $table->text('candidate_requirements')->nullable();
            $table->text('benefits')->nullable();

            $table->date('posted_date')->nullable();
            $table->date('deadline')->nullable();

            $table->integer('views')->default(0);
            $table->tinyInteger('status')->default(0);

            $table->foreign('employer_id')->references('employer_id')->on('employers')->onDelete('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('job_type_id')->references('job_type_id')->on('job_types');
            $table->foreign('salary_id')->references('salary_id')->on('salaries');
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->foreign('location_id')->references('location_id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_postings');
    }
};
