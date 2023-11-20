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
        Schema::create('movie_video_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('movie_video_id');
            $table->boolean('liked'); // 1 for like, 0 for dislike

            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);

            $table->foreign('movie_video_id', 'FK_VideoIdWithMovie_video_likes')->references('id')->on('movie_videos')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_UserIdWithMovie_video_likes')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_video_likes');
    }
};
