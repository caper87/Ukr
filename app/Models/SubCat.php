<?php

namespace Ukr\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class SubCat extends Model
{
    protected $table = 'sub_cat';
	protected $fillable = [
		'sub_cat_id',
		'sub_cat_name',
		'cat_id',
	];
	
	public function cat()
    {
        return $this->belongsTo('Ukr\Models\Cat','cat_id');
    }
    
	static public function getSubCat($cat_id,$obj = null){ //по умолчанию возвращает массив, если передать $obj - вернет объект
		if($obj === null){
			$subcat_list = [];
			$subcats = DB::table('sub_cat')->where('cat_id', $cat_id)->latest()->get();
	    	foreach($subcats as $v){
				$subcat_list[] = $v->sub_cat_name;
			}
			return $subcat_list;
			
		}else{
			 $subcats = DB::table('sub_cat')->where('cat_id', $cat_id)->latest()->get();
			 return $subcats;
		}
	}
}
