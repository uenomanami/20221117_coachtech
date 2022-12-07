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
  }

  </style>
  @section('content')
    <div class="todolist__ttl">
      <div>
        <h1>タスク検索</h1>
      </div>
      <div class="todolist__login">
        @if (Auth::check())
          <p class="todolist__login-item">「{{$user->name}}」でログイン中</p>
        @endif
          <a href="/register" class="todolist__item-logoutbtn">ログアウト</a>
      </div>
    </div>
      <form action="/todo/find" method="get">
    @csrf
      <div class="todolist__item-add">
        <input type="text" name="content" class="todolist__item-addcontent" >
        <input type="submit" value="検索" class="todolist__item-addbtn">
      </div>
      </form>

    @endsection
