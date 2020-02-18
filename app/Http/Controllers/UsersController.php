<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

        //return view('users.show', [
        //    'user' => $user,
        //    'posts' => $posts,
        //]);
        
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];

        $data += $this->counts($user);
        
        return view('users.show', $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);

        $data = [
            'user' => $user,
            'posts' => $favorites,
        ];

        $data += $this->counts($user);

        return view('users.favorites', $data);
    }
}
