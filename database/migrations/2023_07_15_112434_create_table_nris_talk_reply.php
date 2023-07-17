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
        Schema::create('nris_talk_reply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('talk_id');
            $table->unsignedBigInteger('user_id');
            $table->string('comment');
            $table->string('state_id');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('talk_id', 'FK_NRISTALKIDWithREPLY')->references('id')->on('nris_talk')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_NRISTALKUSERIDWithREPLY')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nris_talk_reply');
    }
};
