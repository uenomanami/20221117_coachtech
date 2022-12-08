<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class TodoController extends Controller
{

    protected function logout() {
        Auth::logout();
        return redirect('login');
    }

    public function index()
    {
        $user = Auth::user();
        $todos = Todo::where('user_id', $user->id)->get();
        $tags = Tag::all();
        $param = ['todos' => $todos, 'user' => $user, 'tags' => $tags];;
        // return $user->id;
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

        $user = Auth::user();
        $tags = Tag::all();

        $content = $request->input('content');
        $tag_id = $request->input('tag_id');

        $query = Todo::query();
        //テーブル結合

        if(!empty($content)) {
            $query->where('content', 'LIKE', '%'.$content.'%')
            ->where('user_id', $user->id);
        }
        if(!empty($tag_id)) {
            $query->where('tag_id', $tag_id)
            ->where('user_id', $user->id);
        }

        $todos = $query->get();

        return view('search', compact('todos',  'user', 'tags'));
    }
}
