<?php namespace Ukr\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model {
	
	protected $table = 'posts';
	//protected $guarded = ['img'];﻿
	protected $fillable = [
		'id',
		'tag',
		'title',
		'intro',
		'content',
		'img',
		'cat_id',
		'sub_cat',
		'meta_title',
		'meta_descr',
		'meta_keyw',
		'published',
		'updated_at',
		'created_at'
	];
	
	
	public function cat(){
		return $this->hasMany('Ukr\Models\Cat','cat_id');
	}
	
	public function getPublishedPosts(){
		//$posts = Post::all(); //вывод всех,  get() - команда к получению
		//$posts = Post::latest('id')->get();  //вывод с сорт. по id
		//$posts = Post::latest('published_at')->get();  // вывод по дате публикации
		/*$posts = Post::latest('published_at') // вывод всего, что больше или равно текущей дате(отложенная публикация) 
			->where('published_at', '<=',Carbon::now())
			->get();
		*/
		
		$posts = $this->latest('created_at')->published()->get();
		return $posts;
	}
	
	public function getUnPublishedPosts(){		
		$posts = $this->latest('created_at')->unPublished()->get();
		return $posts;
	}
	
	public function scopePublished($query){
		$query->where('published','=',1);
	}
	
	public function scopeUnPublished($query){
		$query->where('published','=',0);
	}
}
