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

Route::get('qrcode', function () {
    return view('qrcode');
});
Route::get('reader', function () {
    return view('qrcodereader');
});


Route::get('/sign-in', function () {
    return view('auth.login');
});
Route::get('/sign-up', function () {
    return view('auth.register');
});
Route::get('/teacher/sign-up', function () {
    return view('auth.registerTeacher');
});


Route::get('/teacher/section/create', function () {
    return view('teacher.section-create');
});
Route::get('/teacher/assignment/create', function () {
    return view('teacher.assignment-create');
});

Route::get('/teacher/student-check', function () {
    return view('teacher.checkname');
});

//Route::get('/check-in', function () {
//    return view('student.check');
//});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/teacher', 'HomeController@index');
Route::post('/sign-up', 'Auth\RegisterController@createStudent');
Route::post('/teacher/sign-up', 'Auth\RegisterController@createTeacher');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/teacher/subject', 'SubjectController@index');
Route::get('/teacher/subject/section/{id}', 'SubjectController@show');
Route::post('/teacher/subject/section/{id}/post/store', 'SubjectController@postStore');
Route::post('/teacher/subject/section/{id}/lesson/store', 'SubjectController@lessonStore');
Route::get('/teacher/subject/create', 'SubjectController@create');
Route::post('/teacher/subject/store', 'SubjectController@store');
Route::get('/teacher/subject/{id}/add-section', 'SubjectController@addSection');
Route::post('/teacher/subject/{id}/add-section/store', 'SubjectController@sectionStore');

Route::get('/teacher/student-check', 'CheckStudentController@index');
Route::get('/teacher/student-check/check={check_id}/get-qrcode', 'CheckStudentController@getQrcode');
Route::post('/check={check_id}/get-qrcode/update/{time}', 'CheckStudentController@update');
//Route::post('/teacher/student-check/check={check_id}/get-qrcode/update', 'CheckStudentController@update');
Route::post('/teacher/student-check/create', 'CheckStudentController@createCheck');
Route::get('/teacher/student-check/{subject_code}/{section}/{sis_id}','CheckStudentController@detail');

//Route::get('/student/check', 'LocationController@location');

Route::post('/check-in/check', 'LocationController@location');
Route::get('/check-in/{id}/complete', 'LocationController@checkComplete');
Route::get('/check-in/{id}/{time}', 'LocationController@index');

//Route::post('/check-in/check', 'LocationController@location');



Route::get('/teacher/manage','ManageController@index');
Route::get('/teacher/manage/create','ManageController@create');
Route::post('/teacher/manage/section/store','ManageController@storeSection');
Route::post('/teacher/manage/year-term/store','ManageController@storeYear_Term');

Route::get('/teacher/assignment', 'AssignmentController@index');

Route::get('/teacher/assignment/compare', 'AssignmentController@compareIndex');
Route::get('/teacher/assignment/compare/asm={id}', 'AssignmentController@compareShow');
Route::get('/teacher/assignment/compare/file={id}', 'AssignmentController@compareDetail');

Route::get('/teacher/assignment/create', 'AssignmentController@create');
Route::post('/teacher/assignment/store', 'AssignmentController@store');
Route::get('/teacher/assignment/{id}', 'AssignmentController@show');
Route::get('/assignment/{id}', 'AssignmentController@show');
Route::get('/teacher/assignment/{title}/index={arr_index}/work={id}', 'AssignmentController@showWorkDetail');
Route::get('/teacher/assignment/{title}/index={arr_index}/work={id}/next', 'AssignmentController@nextWork');
Route::get('/teacher/assignment/{title}/index={arr_index}/work={id}/previous', 'AssignmentController@previousWork');
Route::post('/teacher/assignment/work={id}/graded', 'AssignmentController@inputGrade');


Route::get('/get-works/id={asm_id}/{grade}', 'AssignmentController@getWork');


Route::post('/assignment/{id}/send', 'WorkController@store');
