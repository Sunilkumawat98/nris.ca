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
        Schema::create('free_classified', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cat_id')->nullable(true);
            $table->unsignedBigInteger('sub_cat_id')->nullable(true);
            $table->text('title')->nullable(true);
            $table->text('title_slug')->nullable(true);
            $table->text('message')->nullable(true);
            $table->text('image')->nullable(true);
            $table->text('contact_name');
            $table->text('contact_email');
            $table->text('contact_number');
            $table->text('contact_address');
            $table->tinyInteger('show_email')->default(0);
            $table->tinyInteger('use_address_map')->default(0);
            $table->text('meta_title')->nullable(true);
            $table->text('meta_description')->nullable(true);
            $table->text('meta_keywords')->nullable(true);
            $table->text('other_details')->nullable(true);
            $table->date('end_at');
            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->tinyInteger('display_status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('user_id', 'FK_User_idWithFreeClassified')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('country_id', 'FK_CountryIdWithFreeClassified')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithFreeClassified')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('cat_id', 'FK_cat_idWithFreeClassified')->references('id')->on('classified_category')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('sub_cat_id', 'FK_sub_cat_idWithFreeClassified')->references('id')->on('classified_sub_category')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_classified');
    }
};
