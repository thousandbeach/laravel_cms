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
Route::get('/', function(){
    $books = Book::orderBy('created_at', 'asc')->get();
    return view('books', ['books' => $books]);
});


// 本の情報の更新画面
Route::post('/booksedit/{books}', function(Book $books){
    // {books}id 値を取得 => Book$books id 値をの１レコード取得
    return view('booksedit', ['book' => $books]);
});


// 本の情報の更新処理
Route::post('/books/update', function(Request $request){
    
    // バリデーション
    $validator = Validator::make($request->all(), [
                        'id' => 'required',
                        'item_name' => 'required | min:3 | max:255',
                        'item_number' => 'required | min:1 | max:3',
                        'item_amount' => 'required | max:6',
                        'published' => 'required',
                    ]);
    
    // バリデーションエラー                
    if($validator->fails()){
        return redirect('/')
            ->withErrors($validator)
            ->withInput();
    }
    
    // Eloquent モデルを用いてDBのテーブルにあるデータを更新して保存
    $books = Book::find($request->id);
    $books->item_name = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published = $request->published;
    $books->save();
    
    return redirect('/');
    
    
    
});

// 新しい本を追加
Route::post('/books', function(Request $request){
    
    // バリデーション
    $validator = Validator::make($request->all(), [
                        'item_name' => 'required|min:3|max:255',
                        'item_number' => 'required|min:1|max:3',
                        'item_amount' => 'required|max:6',
                        'published' => 'required',
                    ]);

    // バリデーションエラー
    if($validator->fails()){
        return redirect('/')
            ->withErrors($validator)
            ->withInput();
    }
    
    // Eloquent モデル
    $books = new Book;
    $books->item_name = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published = $request->published;
    $books->save();
    
    return redirect('/');  // 保存処理が終わったら「'/'」ルートへリダイレクトさせる


});


// 本を削除
Route::delete('/book/{book}', function(Book $book){
    $book->delete();
    return redirect('/');
});