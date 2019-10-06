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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/add','HomeController@addStudent');
Route::get('/teacher/table','TeacherController@dataTable');
Route::get('/teacheredit/{id}','TeacherController@editTeacher');

Route::get('examtable/{grade}','ExamController@createTable');
Route::get('edittable/{grade}/term/{term}/exam/{type}','ExamController@editTable');
Route::get('settable','ExamController@setExamTable');
Route::get('results/{grade}/term/{term}/exam/{type}',['as' =>'examResult','uses' => 'ExamController@getResult']);
Route::get('checkexam/{grade}/term/{term}/exam/{type}',['as' =>'checkexam','uses' => 'ExamController@checkExamExist']);
Route::get('getexam/{id}/{position}','ExamController@pdf');
Route::get('getexamreport/{grade}/{term}/{type}','ExamController@examReport');

Route::get('gettimetable/{grade}','LessonController@getTimeTable');
Route::get('checktimetable/{grade}','LessonController@checkTableExist');
Route::get('getlesson/{grade}/{number}/{day}','LessonController@getLesson');
Route::get('checkteacher/{teacher}/{day}/{number}','LessonController@checkTeacher');
Route::get('printtimetable/{grade}','LessonController@printTimeTable');

Route::get('setfinancetable','FinanceController@setFinanceTable');

Route::get('setstudenttable/{grade}','StudentController@setStudentTable');
Route::get('studentedit/{id}','StudentController@editStudent');
Route::post('saveregister','StudentController@saveRegister');

Route::get('lesson','HomeController@Lessons');
Route::get('performance/{type}','HomeController@subjectChart');
Route::get('examchart','HomeController@examChart');

Route::get('setfeetable','FeesController@getFeeTable');
Route::get('getfeename/{admission}','FeesController@showName');

Route::get('setlibrarytable','LibraryController@getTable');
Route::get('getbookinfo/{book}','LibraryController@bookInfo');
Route::get('fillselect','LibraryController@fillTeacherselect');
Route::post('savelibrary/{id}','LibraryController@saveLibraryTransaction');
Route::get('fillborrowlist/{user}/{id}','LibraryController@getBorrowerBookList');
Route::post('updatereturnedbooks/{id}/{returned}/{status}','LibraryController@updateReturnedBooks');

Route::resource('student','StudentController');
Route::resource('teacher','TeacherController');
Route::resource('finance','FinanceController');
Route::resource('fees','FeesController');
Route::resource('timetable','LessonController');
Route::resource('exam','ExamController');
Route::resource('library','LibraryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
