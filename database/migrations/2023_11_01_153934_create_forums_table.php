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
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cat_id')->nullable(true);
            $table->unsignedBigInteger('sub_cat_id')->nullable(true);
            $table->text('title')->nullable(false);
            $table->text('title_slug')->nullable(false);
            $table->text('description')->nullable(true);
            $table->text('meta_title')->nullable(true);
            $table->text('meta_description')->nullable(true);
            $table->text('meta_keywords')->nullable(true);
            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->tinyInteger('display_status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_User_idWithforums')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithforums')->references('id')->on('forum_category')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('sub_cat_id', 'FK_sub_cat_idWithforums')->references('id')->on('forum_sub_category')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
