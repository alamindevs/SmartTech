<?php
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/logout',function(){
	Auth::logout();
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){
	Route::get('/','DashboardController@dashboard')->name('dashboard');
	/**
	 * All User Route
	 */
	Route::resource('/users','UserController');

	/**
	 * All Cateogry Route
	 */
	Route::get('/categoriesTrees','CategoryController@categoriesTrees')->name('categoryTree');
	Route::get('/categoryAjax','CategoryController@getCategoryAjax')->name('getCategoryAjax');
	Route::delete('/category/destroy','CategoryController@destroy')->name('category.destroy');
	Route::resource('/category','CategoryController')->except('create', 'show', 'destroy');

	/**
	 * All Midea Route
	 */
	Route::get('/midea/dataTable','MideaController@dataTableMidea')->name('midea.dataTable');
	Route::delete('/midea/destroy','MideaController@destroy')->name('midea.destroy');
	Route::resource('/midea','MideaController')->except('create', 'show','destroy');

	/**
	 * All Brand Route
	 */
	
	Route::get('/brand/dataTable','BrandController@dataTableBrand')->name('brand.dataTable');
	Route::delete('/brand/destroy','BrandController@destroy')->name('brand.destroy');
	Route::put('/brand/{brand}/update','BrandController@updateStatus')->name('brand.status');
	Route::resource('/brand','BrandController')->except('destroy','show');
	
});

