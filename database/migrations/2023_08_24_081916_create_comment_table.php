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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('cmt');
            $table->unsignedBigInteger('id_blog');
            $table->unsignedBigInteger('id_user');
            $table->string('avatar');
            $table->string('name');
            $table->unsignedInteger('level')->default(0);
            $table->timestamps();

            $table->foreign('id_blog')->references('id')->on('blog');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
