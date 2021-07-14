<?php


Route::prefix('/admin')->group(function(){
	Route::get('/', 'Admin\DashboardController@getDashboard');
	Route::get('/users', 'Admin\UserController@getUsers');

	//Module Apps
	Route::get('/products', 'Admin\ProductsController@getHome');
	Route::get('/product/add', 'Admin\ProductsController@getProductAdd');
	Route::post('/product/add', 'Admin\ProductsController@postProductAdd');

	//Categorias
	Route::get('/categories/{module}', 'Admin\CategoriesController@getHome');
	Route::post('/category/add', 'Admin\CategoriesController@postCategoryAdd');
	Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit');
	Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit');
	Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete');
});