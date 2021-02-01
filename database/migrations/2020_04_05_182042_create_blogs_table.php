<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->text('blog_text');
            $table->string('photo')->nullable();
            $table->bigInteger('blog_category_id');
            $table->boolean('priority')->default(0);
            $table->integer('number_of_views');
            $table->integer('number_of_comments');
            $table->bigInteger('user_id');
            $table->string('index_page')->default(1);
            $table->timestamps();
            
            
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
