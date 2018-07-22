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
    return view('start');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/update', 'UpdateUserController@index');
Route::get('/update/serial ', 'UpdateUserController@showSerial');
Route::put('/update/{id}', 'UpdateUserController@updateUser');
Route::put('/update/serial/{id}', 'UpdateUserController@updateSerial');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::get('/uploadPicture', 'UploadPictureController@index');

Route::get('/uploadPicture2', 'UploadPictureController@index2');
Route::get('/showAll', 'PhotoController@index');


Route::post('/upload/image', 'UploadPictureController@uploadImage');
Route::post('/delete/image', 'UploadPictureController@deleteImage');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//for vote
Route::post('/vote', 'PhotoController@vote');
Route::post('/share', 'PhotoController@sha');
//for merge image
// Route::get('image-crop', 'ImageController@imageCrop');
// Route::post('image-crop', 'ImageController@imageCropPost');

Route::post('/crop', 'PhotoController@crop');
//test
Route::get('/upload', 'PhotoController@uploadImageAjax');
