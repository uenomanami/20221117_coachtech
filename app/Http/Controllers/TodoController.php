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
        $user = Auth::user();
        // $form = $request->input('tag_id');
        $form = $request->all();
        $param = ['form' => $form, 'user' => $user];
        // return $form.$user;
        Todo::create($param);
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

    public function search(Request $request)
    {
        $tag = $request->tags;
        $content = $request->content;
        Todo::where('tag', $tag);
        return redirect('/todo');
    }
}
