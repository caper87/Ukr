<?php

namespace Ukr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Ukr\Models\Cat;
use Ukr\Models\SubCat;
use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;

class CatController extends Controller
{
	protected $cat;
	
	public function __construct(Cat $cat) {

        $this->cat = $cat;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cat = $this->cat->all();
		return view('admin.cat.index',['cats' => $cat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.cat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cat->create($request->all());
		return redirect()->route('admin.cat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = $this->cat->query()->where('cat_id','=',$id)->get();
		return view('admin.cat.show',['cat' => $cat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
    	$cat = $this->cat->query()->where('cat_id','=',$id)->get();
		$subcat_list = SubCat::getSubCat($id,1);
		return view('admin.cat.edit',['cat' => $cat,'subcat' => $subcat_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $this->cat->where('cat_id',$id)->update($request->except('_token','_method','sub_cat_id'));
		return redirect()->route('admin.cat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cat->where('cat_id',$id)->delete();
		return redirect()->route('admin.cat.index');
    }
}
