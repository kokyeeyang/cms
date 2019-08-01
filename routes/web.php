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

Route::get('/post/{id}/{name}', 'PostsController@showPost');

Route::get('/insert', function(){
	DB::insert('insert into posts(title, content) values(?, ?)', ['PHP with Laravel', 'Framework']);
});

Route::get('/read', function(){
	$results = DB::select('SELECT * FROM posts WHERE id = ?', [1]);

	foreach($results as $result){
		var_dump($result->title);
	}
});

Route::get('/update', function(){
	$updated = DB::update('UPDATE posts SET title = "Bananas", content = "yellow" WHERE id=?', [1]);
	return ('record updated');
});

Route::get('/delete', function(){
	$deleted = DB::delete('DELETE FROM posts WHERE id=?', [1]);

	return $deleted;
});


