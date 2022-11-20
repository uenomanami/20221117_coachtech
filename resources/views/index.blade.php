<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TodoList</title>

  <link rel="stylesheet" href="../css/reset.css" />

  <style>
    body{
      background-color: rgb(45,30,122);
    }

    .todolist{
      background-color: white;
      border-radius: 10px;
      width: 50%;
      margin: 100px auto;
      padding: 30px;
    }
    
    .todolist__ttl {
      font-size: 24px;
    }

    .todolist__item-add {
      display: flex;
      justify-content: space-between;
    }

    .todolist__item-addcontent{
      border: 1px solid lightgray;
      height: 36px;
      width: 85%;
      border-radius: 5px;
    }
    
    .todolist__item-addbtn,.todolist__item-updatebtn,.todolist__item-deletebtn{
      background-color: white;
      font-weight: bold;
      border-radius: 5px;
      height: 36px;
      text-align: center;
      padding: 2px 10px;
    }
    
    .todolist__item-addbtn{
      color: rgb(219,117,247);
      border: 2px solid rgb(219,117,247);
    }
    
    table {
      width:100%;
    }

    td {
      text-align:center;
    }

    th{
      padding:20px 0;
    }

    .todolist__item-edit {
      border: 1px solid lightgray;
      height: 24px;
      width: 100%;
      border-radius: 5px;

    }
    .todolist__item-updatebtn{
      color: rgb(248,151,116);
      border: 2px solid rgb(248,151,116);
    }

    .todolist__item-deletebtn{
      color: rgb(119,249,220);
      border: 2px solid rgb(119,249,220);
    }


  </style>
</head>
<body>
  <div class="todolist">
    <h1 class="todolist__ttl">Todo List</h1>
    <form action="/add" method="post">
    @csrf
      <div class="todolist__item-add">
        <input type="text" name="content" class="todolist__item-addcontent" >
        <input type="submit" value="追加" class="todolist__item-addbtn">
      </div>
      </form>
      @if (count($errors) > 0)
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
      </ul>
      @endif
      <div class="todolist__item">

    <table>
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      @foreach ($todos as $todo)
      <form action="/update" method="post">
      @csrf
        <tr>
          <input type="hidden" name="id" value="{{$todo->id}}" >
          <td>{{$todo->created_at}}</td>
          <td><input type="text" name="content" value="{{$todo->content}}" class="todolist__item-edit"></td>
          <td><input type="submit" name="update" value="更新" class="todolist__item-updatebtn"></td>
        </form>
        <form action="/delete" method="post">
          @csrf
          <input type="hidden" name="id" value="{{$todo->id}}" >
          <td><input type="submit" name="delete" value="削除" class="todolist__item-deletebtn"></td>
        </tr>
      </form>
      @endforeach
    </table>

    </div>
  </div>
</body>
</html>