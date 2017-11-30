@extends('layouts.app')

@section('content')

    
    <!-- Bootstrap の定形コード -->
    <div class="panel-body">
        <!-- Auth 表示 -->
        @if(isset($auths))
            @foreach($auths as $auth)
                <div>
                    <span>{{ $auths->id }}</span>
                    <span>{{ $auths->name }}</span>
                    <span>{{ $auths->email }}</span>
                </div>
            @endforeach
        @endif
        <!-- /Auth 表示 -->
        <!-- バリデーションエラーの表示に使用 -->
        @include('common.errors')
        <!-- /バリデーションエラーの表示に使用 -->
        
        <!-- 本登録フォーム -->
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            
            <!-- 本のタイトル -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input type="text" name="item_name" id="book-name" class="form-control"/>
                </div>
                <div class="col-sm-6">
                <label for="number" class="col-sm-3 control-label">何冊</label>
                    <input type="text" name="item_number" id="book-number" class="form-control"/>
                </div>
                <div class="col-sm-6">
                <label for="amount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" id="book-amount" class="form-control"/>
                </div>
                <div class="col-sm-6">
                <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" id="book-published" class="form-control" placeholder="    /月 /日"/>
                </div>
            </div>
            
            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Save
                    </button>
                </div>
            </div>
        </form>
        <!-- 現在の本 -->
        @if(count($books) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    現在の本
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダー -->
                        <thead>
                            <tr>
                                <th>本一覧</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <!-- 本のタイトル -->
                                    <td class="table-text">
                                        <div>{{ $book->item_name }}</div>
                                    </td>
                                    
                                    <!-- 本の更新ボタン -->
                                    <td class="table-text">
                                        <form action="{{ url('booksedit/' . $book->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">
                                                <i class="glyphicon glyphicon-pencil"></i> 更新
                                            </button>
                                        </form>
                                        
                                    </td>
                                
                                    <!-- 本の削除ボタン -->
                                    <td>
                                        <form action="{{ url('book/' . $book->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                <i class="glyphicon glyphicon-trash"></i> 削除
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $books->links() }}
                </div>
            </div>
        @endif
    </div>
    
    <!-- 既に登録されている本のリスト -->
    
@endsection