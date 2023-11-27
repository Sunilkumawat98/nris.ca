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
        Schema::create('carpools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_country_id')->nullable(true);
            $table->unsignedBigInteger('to_country_id')->nullable(true);
            $table->unsignedBigInteger('from_state_id')->nullable(true);
            $table->unsignedBigInteger('to_state_id')->nullable(true);
            $table->unsignedBigInteger('from_city_id')->nullable(true);
            $table->unsignedBigInteger('to_city_id')->nullable(true);
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('journey_type', ['oneway', 'twoway']);
            $table->text('contact_name');
            $table->text('contact_email');
            $table->text('contact_number');
            $table->text('contact_address');
            $table->date('start_date');
            $table->date('end_date')->nullable(true);
            $table->string('start_time', 10);
            $table->string('end_time', 10)->nullable(true);
            $table->enum('flex_date', ['yes', 'no'])->default('no');
            $table->enum('flex_time', ['yes', 'no'])->default('no');
            $table->enum('flex_location', ['yes', 'no'])->default('no');

            $table->integer('total_views')->unsigned()->default(0);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);


            $table->foreign('from_country_id', 'FK_FromCountryIdWithCarpools')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('to_country_id', 'FK_ToCountryIdWithCarpools')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('from_state_id', 'FK_FromStateIdWithCarpools')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('to_state_id', 'FK_ToStateIdWithCarpools')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('from_city_id', 'FK_FROMCITYIdWithCarpools')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('to_city_id', 'FK_TOCITYIdWithCarpools')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithCarpools')->references('id')->on('carpool_category')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_USERIDWithCarpools')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpools');
    }
};
