<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table)
        {
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');
        });

        Schema::table('comments', function(Blueprint $table)
        {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('commentator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table)
        {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['image_id']);
        });

        Schema::table('comments', function(Blueprint $table)
        {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['commentator_id']);
        });
    }
}
