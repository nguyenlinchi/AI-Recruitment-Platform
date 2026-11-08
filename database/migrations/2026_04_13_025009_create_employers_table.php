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
        Schema::create('employers', function (Blueprint $table) {
            $table->id('employer_id');
            $table->unsignedBigInteger('account_id');

            $table->string('company_name', 150)->nullable();
            $table->string('contact_name', 100)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('cover_image')->nullable();
            $table->text('avatar')->nullable();

            // thông tin công ty
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->string('company_size', 50)->nullable();
            $table->integer('founded_year')->nullable();

            $table->foreign('account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('cascade');
            
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
        Schema::dropIfExists('employers');
    }
};
