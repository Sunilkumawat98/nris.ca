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
        Schema::create('business_sub_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('color', 10);
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);
            $table->foreign('category_id', 'FK_category_idWithBusiness_category')->references('id')->on('business_category')->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_sub_category');
    }
};
