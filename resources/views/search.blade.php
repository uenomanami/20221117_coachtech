@extends('layouts.default')
<style>
  .todolist h1 {
    font-size: 24px;
  }

  .todolist__ttl {
    display:flex;
    justify-content:space-between;
    align-items:center;
  }

  .todolist__login-item {
    display:inline-block;
  }

  .todolist__item-logoutbtn,.todolist__item-tagbtn{
    text-decoration:none;
    display:inline-block;
    font-weight: bold;
    border-radius: 5px;
    height: 32px;
    text-align: center;
    padding: 2px 10px;
    line-height:32px;
    font-size:14px;
  }

  .todolist__item-logoutbtn {
    color: red;
    border: 2px solid red;
    margin-left:10px;
  }
  
  .todolist__item-tagbtn{
    color: lightgreen;
    border: 2px solid lightgreen;
    margin-bottom: 10px;
  }

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

  .todolist__item-tag {
    
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
  </style>


  @section('content')
    <div class="todolist__ttl">
      <div>
        <h1> Todo検索</h1>
      </div>
      <div class="todolist__login">
        @if (Auth::check())
          <p class="todolist__login-item">「{{$user->name}}」でログイン中</p>
        @endif
          <a href="/register" class="todolist__item-logoutbtn">ログアウト</a>
      </div>
    </div>
        @if (Auth::check())

      <form action="/search/find" method="get">
      @endif

    @csrf
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
