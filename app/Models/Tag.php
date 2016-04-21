<?php

namespace Ukr\Models;
use Ukr\Models\Post;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'tag_id';
	protected $fillable = [
		'tag_id',
		'tag_name',
	];
	
	public function post(){
		return $this->belongsToMany('Ukr\Models\Post');
	}
	
	static public function allTag(Post $postModel){
		 
		$tag_list = [];
		$tags = DB::table('tag')->select('tag_id','tag_name')->get();
    	foreach($tags as $v){
			$tag_list[$v->tag_id] = $v->tag_name;
		}
		return $tag_list;
	}
	
	
}
