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
        Schema::create('free_classified_bid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('classified_id');
            $table->text('comments');
            $table->float('amount', 8, 2); // 8 total digits with 2 digits after the decimal point
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_User_IdWithFreeClassifiedBid')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('classified_id', 'FK_cat_idWithFreeClassifiedBis')->references('id')->on('free_classified')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_classified_bid');
    }
};
