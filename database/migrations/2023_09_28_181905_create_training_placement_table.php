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
        Schema::create('training_placements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->date('expire_at');
            $table->integer('total_views')->nullable();
            $table->tinyInteger('is_live')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('status')->default(1);            
            $table->foreign('country_id', 'FK_CountryIdWithTraningPlacement')->references('id')->on('countries')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('state_id', 'FK_StateIdWithTraningPlacement')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('cat_id', 'FK_cat_idWithTraningPlacement')->references('id')->on('training_placement_categories')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'FK_USERIDWithTraningPlacement')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('admin_id', 'FK_ADMINIDWithTraningPlacement')->references('id')->on('admins')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_placements');
    }
};
