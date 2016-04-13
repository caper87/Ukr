<?php

namespace Ukr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Ukr\Models\Tag;
use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;

class TagController extends Controller
{
	/**
     * @var \Category
     */
    protected $tag;
    
	public function __construct(Tag $tag) {

        $this->tag = $tag;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = $this->tag->all();
		
		return view('admin.tag.index',['tags' => $tag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tag $tagModel,Request $request)
    {
        $tagModel->create($request->all());
		return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Tag $tagModel)
    {
        $tagModel->where('tag_id',$id)->delete();
		//Session::flash('message', 'Successfully deleted the nerd!');
		return redirect()->route('admin.tag.index');
    }
    
     public function addTagAjax(Request $request){
     	
		$this->tag->create($request->all());

		$tag = $this->tag->max('tag_id');
		
		return $tag;
	}
	
	 public function delTagAjax(){
		$id = Input::get('tag_id');
		$this->tag->where('tag_id',$id)->delete();
	}
}





