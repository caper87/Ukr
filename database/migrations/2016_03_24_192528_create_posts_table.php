<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function (Blueprint $table) {
		 $table->increments('id', 11);
		 $table->string('tag', 255);
		 $table->string('title', 255);
		 $table->text('content');
		 $table->string('img', 255);
		 $table->string('cat', 255);
		 $table->string('sub_cat', 255);
		 $table->string('meta_title', 255);
		 $table->string('meta_descr', 255);
		 $table->string('meta_keyw', 255);
		 $table->boolean('published');
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
		Schema::drop('posts');
	}

}
