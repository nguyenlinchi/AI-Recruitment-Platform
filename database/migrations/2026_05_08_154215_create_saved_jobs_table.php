<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_jobs', function (Blueprint $table) {

            $table->unsignedBigInteger('candidate_id');

            $table->unsignedBigInteger('job_id');

            $table->timestamp('created_at')
                ->useCurrent();

            // PRIMARY KEY
            $table->primary([
                'candidate_id',
                'job_id'
            ]);

            // FOREIGN KEY
            $table->foreign('candidate_id')
                ->references('candidate_id')
                ->on('candidates')
                ->onDelete('cascade');

            $table->foreign('job_id')
                ->references('job_id')
                ->on('job_postings')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};