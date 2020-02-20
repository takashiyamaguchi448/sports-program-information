<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = Post::query();
        
        $search1 = $request->input('word');
        
        if ($request->has('word') && $search1 != '') {
            $query->where('content', 'like', '%'.$search1.'%')->get();
        }
        $data = $query->paginate(10);

        return view('welcome',[
            'posts' => $data
        ]);
    }
}