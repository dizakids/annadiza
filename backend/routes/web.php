<?php
/*
use App\Http\Middleware\TagMiddleware;

Route::resource('articles','ArticlesController')->middleware(TagMiddleware::class);

Route::get('/', 'ArticlesController@index')->middleware(TagMiddleware::class);

Route::get('/show_image/{filename}', 'ArticlesController@show_image');

Route::resource('tags', 'TagsController', ['except' => ['show']])->middleware(TagMiddleware::class);

Route::get('/tags/{tag_id}/tag_article_index', 'TagsController@tag_article_index')->middleware(TagMiddleware::class);

Route::resource('users', 'UsersController', ['only' => ['index', 'edit', 'update','destroy']])->middleware(TagMiddleware::class);

Route::get('/daily_index', 'ArticlesController@daily_index')->name('articles.daily_index')->middleware(TagMiddleware::class);

Route::get('/new_arrivals_index', 'ArticlesController@new_arrivals_index')->name('articles.new_arrivals_index')->middleware(TagMiddleware::class);

Auth::routes(['reset' => false]);

Route::group(['middleware' => ['auth', 'can:admin_user']], function () {
  Route::get('/manager', 'ManagerController@manager')->middleware(TagMiddleware::class);
});
*/

Route::get('/show_image/{filename}', 'ArticlesController@show_image');


?>