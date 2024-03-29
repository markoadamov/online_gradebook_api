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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gradebook_id')->nullable();
            //$table->unsignedBigInteger('gradebook_id');
            //$table->foreign('gradebook_id')->references('id')->on('gradebooks')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->text('image_url')->default(null);
            $table->boolean('accepted_terms');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
