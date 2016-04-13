<?php namespace Ukr\Http\Controllers;

use Ukr\Http\Requests;
use Ukr\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ukr\Models\Post;

class PostController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Post $postModel)
	{	
		$posts = $postModel->getPublishedPosts();
		
		return view('posts.index',['posts' => $posts]);
	}
	
	public function show($id,Post $postModel)
	{
		$post = $postModel->query()->where('id','=',$id)->get();
		return view('posts.show',['post' => $post]);
	}
	
	public function published(Post $postModel)
	{	
		$posts = $postModel->getPublishedPosts();
		
		return view('posts.index',['posts' => $posts]);
	}
	
	public function unpublished(Post $postModel)
	{	
		$posts = $postModel->getUnPublishedPosts();
		
		return view('posts.index',['posts' => $posts]);
	}
}
