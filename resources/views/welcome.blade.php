@extends('layouts.app')

@section('content')
    @if (Auth::check())
         <div class="col-sm-8">
            <form method="get" action="/search">
                <label for="word">検索キーワード</label>
                <input type="text" name="word">
                <input type="submit" value="検索">
            </form> 
            @if (count($posts) > 0)
                @include('posts.posts', ['posts' => $posts])
            @endif
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Sports topics</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection