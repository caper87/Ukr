<?php

namespace Ukr\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
	protected $fillable = [
		'tag_id',
		'tag_name',
	];
	
	static public function allTag(){
		$tag_list = [];
		$tags = DB::table('tag')->select('tag_name')->get();
    	foreach($tags as $v){
			$tag_list[] = $v->tag_name;
		}
		return $tag_list;
	}
}
