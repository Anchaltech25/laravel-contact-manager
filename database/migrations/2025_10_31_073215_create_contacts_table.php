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
        Schema::create('contacts', function (Blueprint $table) {
              $table->string('name');
            $table->string('email')->unique();
            $table->string('number')->unique();
            $table->text('bio')->nullable();
            // user_id unique requirement: one-to-one mapping between contact and user
            $table->unsignedBigInteger('user_id')->unique(); 
            $table->boolean('is_active')->default(true);
            $table->string('profile_image')->nullable();
            $table->softDeletes(); // soft delete
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
