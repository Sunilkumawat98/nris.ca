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
        Schema::create('gif_ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable(true);
            $table->unsignedBigInteger('state_id')->nullable(true);
            $table->unsignedBigInteger('category_id');
            $table->text('ad_name');
            $table->text('ad_contact')->nullable(true);
            $table->text('ad_address')->nullable(true);
            $table->float('amount', 8, 2);
            $table->enum('ad_position', ['top', 'left', 'right'])->nullable(true);
            $table->text('image');
            $table->text('click_url')->nullable(true);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);


            $table->foreign('country_id', 'FK_CountryIdWithgif_ads')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithgif_ads')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('category_id', 'FK_category_idWithgif_ads')->references('id')->on('classified_category')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gif_ads');
    }
};
