<?php namespace Ukr\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Post extends Model {
	
	protected $table = 'posts';
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
		return $this->hasOne('Ukr\Models\Cat','cat_id');
	}
	
	public function tag(){
		return $this->belongsToMany('Ukr\Models\Tag');
	}
	
	public function getPublishedPosts(){
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
