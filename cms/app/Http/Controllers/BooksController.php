<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;  // 藤原_追加 モデル利用のため
use Validator; // 藤原_追加 バリデーション使用のため

class BooksController extends Controller
{

    // 本のダッシュボード表示
    public function index(Request $request)
    {
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        return view('books', ['books' => $books]);
    }


    // 新規登録の処理
    public function store(Request $request)
    {
        // バリデーション
         $validator = Validator::make($request->all(), [
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

        // モデル 本の作成処理
        $book = new Book;
        $book->item_name = $request->item_name;
        $book->item_number = $request->item_number;
        $book->item_amount = $request->item_amount;
        $book->published = $request->published;
        $book->save();
        return redirect('/');
    }


    // 更新画面の処理
    public function edit(Book $books)
    {
        return view('booksedit', ['book' => $books]);
    }


    // 更新の処理
    public function update(Request $request){

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

        // モデル DB更新・保存 保存したらリダイレクト
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/');


    }


    // 削除の処理
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/');
    }

}
