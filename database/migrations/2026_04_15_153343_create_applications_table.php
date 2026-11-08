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
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');

            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('resume_id')->nullable();

            $table->text('resume_link')->nullable();
            $table->date('applied_date')->useCurrent();
            $table->tinyInteger('status')->default(0);

            $table->foreign('job_id')->references('job_id')->on('job_postings')->onDelete('cascade');
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');
            $table->foreign('resume_id')->references('resume_id')->on('resumes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
