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
        Schema::table('nris_talk', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id')->nullable()->change();
            $table->renameColumn('title-slug', 'title_slug');
            $table->string('meta_title')->nullable()->change();
            $table->string('meta_description')->nullable()->change();
            $table->string('meta_keywords')->nullable()->change();
            $table->string('total_views')->nullable()->change();
            $table->foreign('state_id', 'FK_NRISTALKStateWithStateId')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            
        });
    
        Schema::table('nris_talk_reply', function (Blueprint $table) {
            $table->unsignedBigInteger('state_id')->nullable()->change();           
            $table->foreign('state_id', 'FK_NRISTALKReplyStateWithStateId')->references('id')->on('states')->onDelete('restrict')->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nris_talk', function (Blueprint $table) {       
            $table->renameColumn('title_slug','title-slug');
            $table->string('meta_title')->nullable(false)->change();
            $table->string('meta_description')->nullable(false)->change();
            $table->string('meta_keywords')->nullable(false)->change();
            $table->string('total_views')->nullable(false)->change();
            $table->dropForeign('FK_NRISTALKStateWithStateId');
        });

        Schema::table('nris_talk', function (Blueprint $table) {
            $table->string('state_id')->nullable(false)->change();            
        });


        Schema::table('nris_talk_reply', function (Blueprint $table) {            
            $table->dropForeign('FK_NRISTALKReplyStateWithStateId');
        });

        Schema::table('nris_talk_reply', function (Blueprint $table) {
            $table->string('state_id')->nullable(false)->change();            
        });

    }
};
