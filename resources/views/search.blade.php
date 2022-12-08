@extends('layouts.default')
<style>
  .todolist__item-search {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .todolist__item-searchcontent{
    border: 1px solid lightgray;
    height: 36px;
    width: 75%;
    border-radius: 5px;
  }

  .todolist__item-searchbtn{
    background-color: white;
    font-weight: bold;
    border-radius: 5px;
    height: 32px;
    text-align: center;
    padding: 2px 10px;
    font-size: 14px;
  }

  .todolist__item-searchbtn{
    color: rgb(219,117,247);
    border: 2px solid rgb(219,117,247);
  }

  .todolist__item-backbtn{
    text-decoration:none;
    display:inline-block;
    font-weight: bold;
    border-radius: 5px;
    height: 32px;
    text-align: center;
    padding: 2px 10px;
    line-height:32px;
    font-size:14px;
    color: gray;
    border: 2px solid gray;
  }
  
</style>


@section('title')
タスク検索
@endsection

@section('content')

@if (Auth::check())
<form action="/search/find" method="get">
@csrf
@endif
  <div class="todolist__item-search">
  <input type="text" name="content" class="todolist__item-searchcontent" >
    <select name="tag_id" class="todolist__item-tag">
      <option value=""></option>
      @foreach ($tags as $tag)
      <option value="{{ $tag->id }}">{{ $tag->content }}</option>
      @endforeach
    </select>
    <input type="submit" value="検索" class="todolist__item-searchbtn">
  </div>
</form>

@if (count($errors) > 0)
<ul>
  @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
</ul>
@endif

@endsection

@section('back__btn')
  <a href="/home" class="todolist__item-backbtn">戻る</a>
@endsection
