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
        Schema::create('business_listing_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_list_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_UserIdWithBusinessListingReviews')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('business_list_id', 'FK_BusinessListIdWithBusinessListingReviews')->references('id')->on('business_listings')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('country_id', 'FK_CountryIdWithBusinessListingReviews')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithBusinessListingReviews')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_listing_reviews');
    }
};
