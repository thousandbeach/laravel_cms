@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        @include('common.errors')
        <form action="{{ url('books/update') }}" method="POST">
            
            <!-- item_name -->
            <div class="form-group">
                <label for="item_name">Title</label>
                <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $book->item_name }}">
            </div>
            <!-- /item_name -->
            
            <!-- item_number -->
            <div class="form-group">
                <label for="item_number">Number</label>
                <input type="text" name='item_number' id="item_number" class="form-control" value="{{ $book->item_number }}">
            </div>
            <!-- /item_number -->
            
            <!-- item_amount -->
            <div class="form-group">
                <label for="item_amount">Amount</label>
                <input type="text" name="item_amount" id="item_number" class="form-control" value="{{ $book->item_amount }}">
            </div>
            <!-- /item_number -->
            
            <!-- published -->
            <div class="form-group">
                <label for="">Published</label>
                <input type="date" name="published" id="published" class="form-control" value="{{ $book->published }}">
            </div>
            <!-- /published -->
            
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button ="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}">
                    <i class="glyphicon glyphicon-backward"></i> Back
                </a>
            </div>
            <!-- /Save ボタン/Back ボタン -->
            
            <!-- id値を送信 -->
            <input type="hidden" name="id" value="{{ $book->id }}">
            <!-- / id値を送信 -->
            
            <!-- CSRF対策 -->
            {{ csrf_field() }}
            <!-- /CSRF対策 -->
            
        </form>
    </div>
</div>

@endsection
