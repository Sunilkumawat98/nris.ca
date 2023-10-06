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
        Schema::create('training_placement_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('training_list_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->text('comment');
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_UserIdWithTrainingComments')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('training_list_id', 'FK_EventListIdWithTrainingComments')->references('id')->on('training_placements')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('country_id', 'FK_CountryIdWithTrainingComments')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithTrainingComments')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_placement_comments');
    }
};
