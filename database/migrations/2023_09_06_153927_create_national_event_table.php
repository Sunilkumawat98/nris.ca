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
        Schema::create('national_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('cat_id');
            $table->text('title');
            $table->text('title_slug');
            $table->text('image')->nullable(true);
            $table->text('url');
            $table->text('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('details')->nullable(true);
            $table->text('meta_title')->nullable(true);
            $table->text('meta_description')->nullable(true);
            $table->text('meta_keywords')->nullable(true);
            $table->text('other_details')->nullable(true);
            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('country_id', 'FK_CountryIdWithNaitionalEvents')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithNaitionalEvents')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_CityIdWithNaitionalEvents')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithNaitionalEvents')->references('id')->on('business_category')->onDelete('restrict')->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_events');
    }
};
