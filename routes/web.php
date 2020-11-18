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

Route::get('/', function () {
    return view('welcome');
});



Route::post('app/create_area','areaController@addArea');
Route::get('app/get_area','areaController@getArea');
Route::post('app/edit_area','areaController@editArea');
Route::post('app/delete_area','areaController@deleteArea');

Route::post('app/upload','findingController@upload');

Route::post('app/uploadmultiple','findingController@uploadMulti');
Route::post('app/save_multi_upload/{temp}/{area_id}/{prog_id}','findingController@addMultiUpload');
Route::get('app/get_uploads_all','findingController@getUploads');
Route::post('app/delete_deliverable/{id}','findingController@deleteUpload');
Route::get('app/prog_multi','findingController@getProg');



Route::get('app/upload_view/{area_id}','findingController@getUploadbyArea');
Route::get('app/upload_view_prog/{prog_id}/{area_id}','findingController@getUploadbyProg');
Route::get('app/prog_view_upload','findingController@getProg');




Route::post('app/create_finding','findingController@addFinding');
Route::get('app/get_finding','findingController@getFinding');
Route::post('app/edit_finding','findingController@editFinding');
Route::post('app/delete_finding/{id}','findingController@deleteFinding');
Route::get('app/prog','findingController@getProg');
Route::get('app/area','findingController@getArea');


Route::get('app/get_user','userController@getUser');
Route::post('app/create_user','userController@addUser');
Route::post('app/edit_user','userController@editUser');
Route::post('app/delete_User','userController@deleteUser');

Route::post('app/login','loginController@user_login');

Route::get('/logout','userController@logout');
Route::get('/','userController@index');
Route::any('{slug}','userController@index');


//home
Route::get('app/prog_view','HomeController@getProg');
Route::get('app/area_view','HomeController@getArea');
Route::get('app/findings_view/{area_id}','HomeController@getFindingbyArea');
Route::get('app/findings_view_prog/{prog_id}/{area_id}','HomeController@getFindingbyProg');

Route::get('app/get_finding_home','HomeController@getFinding');


// Route::get('app/','http://localhost:8000/uploads/operating system.pdf');

Route::post('{deli_data}', function ($deli_data) {
	return view('Route');
});

