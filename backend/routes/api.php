 <?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::get('/users', 'AuthController@index');

Route::get('/index', 'AuthController@index');
Route::post('/logout', 'AuthController@logout');
Route::patch('/{user}', 'AuthController@update');
Route::delete('/{user}', 'AuthController@destroy');

Route::apiResource('articles', 'ArticlesController');
Route::get('/list_articles', 'ArticlesController@list_articles');
Route::get('/new_arrivals_index', 'ArticlesController@new_arrivals_index');

Route::apiResource('photos', 'PhotosController');
Route::get('/list_photos', 'PhotosController@list_photos');
Route::get('/new_foto', 'PhotosController@new_foto');

Route::apiResource('tags', 'TagsController');
Route::get('/tags/{tag_id}/tag_article_index', 'TagsController@tag_article_index');

Route::apiResource('categories', 'CategoriesController');
Route::get('/get_list', 'CategoriesController@get_list');
Route::get('/categories/{category_id}/category_article', 'CategoriesController@category_article');


    Route::prefix("admin")->group(function () {
        Route::prefix("categories")->group(function () {
            Route::get("tree", 'Admin\CategoriesController@tree');
            Route::post("store", 'Admin\CategoriesController@storeCategory');
            Route::delete("/{cat}", "Admin\CategoriesController@removeCategory");
            Route::post("{cat}/{where}", "Admin\CategoriesController@move")->where("where", "up|down");
        });
        Route::resource('posts', 'Admin\PostsController')->except(["create", "edit"]);
    });

//Route::apiResource('/admin/posts', 'Admin\PostsController');