<!DOCTYPE html>
<html lang="ja">
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
    
    .todolist__item-tag,.todolist__item-updatebtn,.todolist__item-deletebtn{
      background-color: white;
      font-weight: bold;
      border-radius: 5px;
      height: 32px;
      text-align: center;
      padding: 2px 10px;
      font-size:14px;
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
    <div class ="content">
      @yield('content')
    </div>

      <div class="todolist__item">

    <table>
      <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>タグ</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      @foreach ($todos as $todo)
      <form action="{{ route('todo.update', ['id' => $todo->id ])}}" method="post">
      @csrf
        <tr>
          <td>{{$todo->created_at}}</td>
          <td><input type="text" name="content" value="{{ $todo->content }}" class="todolist__item-edit"></td>
          <td>
            <select name="tags" class="todolist__item-tag">
              <option value="{{ $todo->tag_id }}">{{ $todo->getTagName() }}</option>
              @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->content }}</option>
              @endforeach
            </select>
          </td>
          <td><input type="submit" name="update" value="更新" class="todolist__item-updatebtn"></td>
        </form>
        <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="post">
          @csrf
          <td><input type="submit" name="delete" value="削除" class="todolist__item-deletebtn"></td>
        </tr>
      </form>
      @endforeach
    </table>

    </div>
  </div>
</body>
</html>