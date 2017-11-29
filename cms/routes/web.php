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

use App\Book;  // 藤原_追加
use Illuminate\Http\Request;  // 藤原_追加


Route::get('/', function () {
    return view('welcome');
});

// 本のダッシュボード表示
Route::get('/', 'BooksController@index');

// 新しい本を新規登録処理
Route::post('/books', 'BooksController@store');

// 本の情報の更新画面
Route::post('/booksedit/{books}', 'BooksController@edit');

// 本の情報の更新処理
Route::post('/books/update', 'BooksController@update');

// 本を削除
Route::delete('/book/{book}', 'BooksController@destroy');
