<?php

namespace Ukr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Ukr\Models\Cat;
use Ukr\Models\SubCat;
use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;
use Input;

class SubCatController extends Controller
{
	protected $subcat;
	
	public function __construct(SubCat $subcat) {

        $this->subcat = $subcat;
       
    }
    
	public function getSubCatAjax(Cat $cat,SubCat $subcat)
	{
		
		$action = Input::get('action');
		$cat_id = Input::get('cat');
		//$cat = $cat->where('cat_id',$categ )->get();
		if (isset($action) && $action == 'getSubCat'){ // проверка параметров
		    if (isset($cat_id)) {// если ключ найден
		    	$subcat = SubCat::getSubCat($cat_id);
		        return json_encode($subcat); // возвращаем массив с данными
		    }else{ // иначе
		    	
		        return json_encode(array('Выберите категорию'));
		    	
			}
		}
	}
	
	public function addSubCatAjax(Request $request)
	{
		
		$this->subcat->create($request->all());

		$subcat = SubCat::max('sub_cat_id');
		
		return $subcat;
	}
	
	public function delSubCatAjax()
	{
		$id = Input::get('sub_cat_id');
		$this->subcat->where('sub_cat_id',$id)->delete();
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subcat->where('sub_cat_id',$id)->delete();
		//Session::flash('message', 'Successfully deleted the nerd!');
		return redirect()->route('admin.cat.index');
    }
}
