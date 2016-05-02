<?php
namespace Ukr\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;
use Ukr\Models\Post;
use Ukr\Models\Post_Tag;
use Ukr\Models\Tag;
use Ukr\Models\Cat;
use Ukr\Models\SubCat;
use Input;
use File;
use Flash;
use DB;
use Session;

class PostController extends Controller
{
	protected $post;
	
	public function __construct(Post $post) {

        $this->post = $post;
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{	
		$posts = $this->post->all();
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	public function show($id)
	{
		$post = $this->post->query()->where('id','=',$id)->get();
		return view('admin.posts.show',['post' => $post]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Tag $tag,Cat $cat)
	{	
		//$tag_list = Tag::allTag();
		$post_id = $this->post->max('id')+1;
    	$cat_list = Cat::allCat();		
        return view('admin.posts.create',['cats' => $cat_list,'post_id' => $post_id]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//валидация форм
		$this->validate($request, [
	        'title' => 'required|max:255',
	        'content' => 'required',
    	]);
    	
    	
    	//загрузка фото       
        if(Input::hasFile('img')){
		   //если фото есть
		   $request->file('img')->move('image/uploads'.'/'.date('Y-m-d').'/', $request->file('img')->getClientOriginalName()); 
	       $data  = $request->except(['img']);
 	       $data['img'] = 'image/uploads'.'/'.date('Y-m-d').'/'.$request->file('img')->getClientOriginalName(); 
	       $this->post->create($data);
	       Flash::message('Рецепт успешно добавлен!');
	       return redirect()->route('admin.posts.index');
	       
		}else{
			//если фото нет
			 $this->post->create($request->all());
			 Flash::message('Рецепт успешно добавлен!');
			 return redirect()->route('admin.posts.index');
		}
	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 
	public function edit($id,Tag $tag,Cat $cat,SubCat $subcat)
	{
		$post = $this->post->query()->where('id','=',$id)->get();
		$tag_list = $this->post->find($id)->tag; 
		$cat_list = Cat::allCat();
		$subcat_list = SubCat::getSubCat($post->lists('cat_id'));
		
		return view('admin.posts.edit',['post' => $post,'tags' => $tag_list,'cats' => $cat_list,'subcat'=>$subcat_list]);
	}
	/*
	 public function edit($id,Tag $tag,Cat $cat,SubCat $subcat)
	{
		$tag_list = $this->post->find($id)->tag;
		$cat_list = Cat::allCat();
		//$cat_list = Post::find($id)->cat;
		$post = $this->post->query()->where('id','=',$id)->get();
		foreach($post as $val){
			$subcat_list = SubCat::getSubCat($val->cat_id);
		}
		return view('admin.posts.edit',['post' => $post,'tags' => $tag_list,'cats' => $cat_list,'subcat'=>$subcat_list]);
	}
	 */

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		if(Input::hasFile('img')){
			
		   //если фото есть
		   $request->file('img')->move('image/uploads'.'/'.date('Y-m-d').'/', $request->file('img')->getClientOriginalName());        
	       $data  = $request->except(['img','_token','_method','tag_name','post_id']); 
 	       $data['img'] = 'image/uploads'.'/'.date('Y-m-d').'/'.$request->file('img')->getClientOriginalName();
	       $this->post->where('id',$id)->update($data);
	       Flash::message('Изменения сохранены!');
	       return redirect()->route('admin.posts.index');
	       
		}else{
			
			//если фото не загружали
			Flash::message('Изменения сохранены!');
			$this->post->where('id',$id)->update($request->except('_token','_method','img','tag_name','post_id'));
			return redirect()->route('admin.posts.index');
			
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->post->where('id',$id)->delete();
		return redirect()->route('admin.posts.index');
	}
    
    public function published()
	{	
		$posts = $this->post->getPublishedPosts();	
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	public function unpublished()
	{	
		$posts = $this->post->getUnPublishedPosts();		
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	
}

