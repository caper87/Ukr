<?php
namespace Ukr\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;
use Ukr\Models\Post;
use DB;
use Session;
use Ukr\Models\Tag;
use Ukr\Models\Cat;
use Ukr\Models\SubCat;
use Input;
use File;
use Flash;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $postModel)
	{	
		$posts = $postModel->all();
		
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	public function show($id,Post $postModel)
	{
		$post = $postModel->query()->where('id','=',$id)->get();
		return view('admin.posts.show',['post' => $post]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Tag $tag,Cat $cat)
	{	
		$tag_list = Tag::allTag();
    	$cat_list = Cat::allCat();		
        return view('admin.posts.create',['tags' => $tag_list,'cats' => $cat_list]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Post $postModel, Request $request)
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

	       $postModel->create($data);
	       Flash::message('Рецепт успешно добавлен!');
	       return redirect()->route('admin.posts.index');
	       
		}else{
			//если фото нет
			 $postModel->create($request->all());
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
	 
	public function edit($id,Post $postModel,Tag $tag,Cat $cat,SubCat $subcat)
	{
		$tag_list = Tag::allTag();
		$cat_list = Cat::allCat();
		//$cat_list = Post::find($id)->cat;
		$post = $postModel->query()->where('id','=',$id)->get();
		foreach($post as $val){
			$subcat_list = SubCat::getSubCat($val->cat_id);
		}
		return view('admin.posts.edit',['post' => $post,'tags' => $tag_list,'cats' => $cat_list,'subcat'=>$subcat_list]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Post $postModel,Request $request)
	{
		if(Input::hasFile('img')){
			
		   //если фото есть
		   $request->file('img')->move('image/uploads'.'/'.date('Y-m-d').'/', $request->file('img')->getClientOriginalName());        
	       $data  = $request->except(['img','_token','_method']); 
 	       $data['img'] = 'image/uploads'.'/'.date('Y-m-d').'/'.$request->file('img')->getClientOriginalName();
	       $postModel->where('id',$id)->update($data);
	       Flash::message('Изменения сохранены!');
	       return redirect()->route('admin.posts.index');
	       
		}else{
			
			//если фото не загружали
			Flash::message('Изменения сохранены!');
			$postModel->where('id',$id)->update($request->except('_token','_method','img'));
			return redirect()->route('admin.posts.index');
			
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Post $postModel)
	{
		$postModel->where('id',$id)->delete();
		//Session::flash('message', 'Successfully deleted the nerd!');
		//return redirect('admin/posts/index');
		return redirect()->route('admin.posts.index');
	}
    
    public function published(Post $postModel)
	{	
		$posts = $postModel->getPublishedPosts();
		
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	public function unpublished(Post $postModel)
	{	
		$posts = $postModel->getUnPublishedPosts();
		
		return view('admin.posts.index',['posts' => $posts]);
	}
	
	
}

