<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('w', function(){
		return view('welcome');
	});
//Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//posts
Route::any('posts',['as' => 'posts','uses' => 'PostController@index']);
Route::resource('posts', 'PostController');

//Route::get('subcat','Admin\SubCatController@getSubCatAjax'); 
// admin
Route::group(array( 'prefix'   	  => '/admin',
                    'namespace'   => 'Admin',
                    'middleware'  => ['auth']), 
                       function () {

        // admin cab
        Route::get('/', array('as' => 'admin.cab', 'uses' => 'CabController@index'));
		
		
        // user
        Route::get('users', array('as' => 'admin.users', 'uses' => 'UserController@index'));
        Route::resource('users', 'UserController');
        Route::get('users/{id}/delete', array('as'   => 'admin.users.delete',
                                             'uses' => 'UserController@destroy'));

		// posts
		Route::get('posts', array('as' => 'admin.posts', 'uses' => 'PostController@index'));
		Route::any('posts/published',['as' => 'admin.posts.published','uses' => 'PostController@published']);
		Route::any('posts/unpublished',['as' => 'admin.posts.unpublished','uses' => 'PostController@unpublished']);
        Route::resource('posts', 'PostController');
        Route::get('posts/{id}/delete', array('as'   => 'admin.posts.delete',
                                             'uses' => 'PostController@destroy'));
                                            
                                             
        //tags
        Route::any('tagadd', 'TagController@addTagAjax');
        Route::any('tagdel', 'TagController@delTagAjax');
        Route::any('tag',['as' => 'admin.tag.index','uses' => 'TagController@index']);
        Route::resource('tag', 'TagController');
        Route::get('tag/{id}/delete', array('as'   => 'admin.tag.delete',
                                             'uses' => 'TagController@destroy'));
        
        //cats
        Route::any('cat',['as' => 'admin.cat.index','uses' => 'CatController@index']);
        Route::resource('cat', 'CatController');
        Route::get('cat/{id}/delete', array('as'   => 'admin.cat.delete',
                                             'uses' => 'CatController@destroy'));
        
        //subcats
        Route::any('subcat', 'SubCatController@getSubCatAjax');
        Route::any('subcat/add', 'SubCatController@addSubCatAjax');
        Route::any('subcat/del', 'SubCatController@delSubCatAjax');
        //Route::get('subcat/{id}/delete', array('as'   => 'admin.subcat.delete', 'uses' => 'SubCatController@destroy'));
        //Route::resource('subcat', 'SubCatController');                                          
  
});










