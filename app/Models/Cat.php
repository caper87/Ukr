<?php

namespace Ukr\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table = 'cat';
	protected $fillable = [
		//'cat_id',
		'cat_name',
		'cat_descr',
	];
	public function subcat(){
		return $this->hasMany('Ukr\Models\SubCat','cat_id');
	}
	
	static public function allCat(){
		$cat_list = [];
		$cat_list[] = 'Выберите категорию';
		$cats = DB::table('cat')->select('cat_name')->get();
    	foreach($cats as $v){
			$cat_list[] = $v->cat_name;
		}
		return $cat_list;
	}
}
