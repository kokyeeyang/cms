<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Post;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/post/{id}', 'PostsController@index');

// Route::resource('posts', 'PostsController');

Route::get('/contact', 'PostsController@contact');

Route::get('/read', function(){
	$posts = Post::all();

	foreach($posts as $post){
		return $post->title;
	}

});

Route::get('/find', function() {
	$post = Post::find(2);

	var_dump($post->title);
});

Route::get('/findwhere', function() {
	$post = Post::where('id', 3)->orderBy('id', 'asc')->take(1)->get();
	return($post);
});

Route::get('/post/{id}/{name}', 'PostsController@showPost');

Route::get('/insert', function(){
	DB::insert('insert into posts(title, content) values(?, ?)', ['CIA', 'Top secret']);
});

Route::get('/read', function(){
	$results = DB::select('SELECT * FROM posts WHERE id = ?', [1]);

	foreach($results as $result){
		var_dump($result->title);
	}
});

Route::get('/findmore', function (){
	// $posts = Post::findOrFail(6);

	$posts = Post::where('user_count', '<', 50)->firstOrFail();

	return $posts;
});

Route::get('/basicinsert', function() {
	$post = new Post; 

	$post->title = 'Vegetables';
	$post->content = 'Carrots are healthy';

	$post->save();

});

Route::get('save', function() {
	$post = Post::find(5);

	$post->title = 'I have changed this post now';
	$post->content = 'It is mine now';

	$post->save();
});

Route::get('/update', function(){
	Post::where('id', 4)->where('is_admin',0)->update(['title'=>'party animal', 'content'=>'party all night long']);
	return ('record updated');
});

Route::get('/delete', function(){
	$deleted = DB::delete('DELETE FROM posts WHERE id=?', [1]);

	return $deleted;
});

Route::get('/create', function() {
	Post::create(['title' => 'we have changed the method', 'content' => 'woohoooooooooo']);
});

Route::get('/delete' , function() {
	$post = Post::find(2);

	$post->delete();
});

Route::get('/destroy', function() {
	$post = Post::destroy([4,5]);

});


