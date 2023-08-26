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
        Schema::create('business_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cat_id')->nullable(true);
            $table->unsignedBigInteger('sub_cat_id')->nullable(true);
            $table->text('name')->nullable(true);
            $table->text('name_slug')->nullable(true);
            $table->text('image')->nullable(true);
            $table->text('contact_name');
            $table->text('contact_email');
            $table->text('contact_number');
            $table->text('contact_address');
            $table->text('meta_title')->nullable(true);
            $table->text('meta_description')->nullable(true);
            $table->text('meta_keywords')->nullable(true);
            $table->text('other_details')->nullable(true);
            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->tinyInteger('display_status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithBusinessListing')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithBusinessListing')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithBusinessListing')->references('id')->on('business_category')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('sub_cat_id', 'FK_sub_cat_idWithBusinessListing')->references('id')->on('business_sub_category')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_listings');
    }
};
