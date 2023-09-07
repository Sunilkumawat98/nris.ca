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
        Schema::table('free_classified', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->after('state_id')->nullable(true);
            $table->foreign('city_id', 'FK_CityIdWithFreeClassified')->references('id')->on('cities')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_classified', function (Blueprint $table) {
            $table->dropForeign('FK_CityIdWithFreeClassified');
        });

        Schema::table('free_classified', function (Blueprint $table) {
            $table->dropColumn('city_id'); // Drop the "image" column
        });
    }
};
