<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = ['todos' => $todos, 'user' => $user, 'tags' => $tags];
        return view('index', $param);
    }

    // public function post(Request $request)
    // {
    //     return view('index');
    // }

    public function add(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/home');
    }

    public function update(TodoRequest $request)
    {
        // $todo = Todo::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/home');
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/home');
    }

    public function search()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $param = ['user' => $user, 'tags' => $tags];

        return view('search', $param);
    }

    public function find(Request $request)
    {
        $request_content = $request->input('content');
        $request_tag = $request->input('tag_id');

        $query = Todo::query();
        //テーブル結合
        $query->join('tags', function ($query) use ($request) {
            $query->on('todos.tag_id', '=', 'tags.id');
            });

        if(!empty($request_content)) {
            $query->where('content', 'LIKE', "%{$request_content}%");
        }
        if(!empty($request_tag)) {
            $query->where('tag_id', 'LIKE', $request_tag);
        }

        $todos = $query->get();

        $user = Auth::user();
        $tags = Tag::all();

        return view('search', compact('todos',  'user', 'tags'));
    }
}
