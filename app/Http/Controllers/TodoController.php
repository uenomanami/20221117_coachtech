<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', ['todos' => $todos]);
    }

    public function post(Request $request)
    {
        return view('index');
    }

    public function add(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        // $todo = Todo::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update(['content' => $request->content]);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/');
    }
}
