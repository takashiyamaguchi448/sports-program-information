@if (Auth::user()->is_favorite($post->id))
    {!! Form::open(['route' => ['favorites.unfavorite', $post->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-warning btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['favorites.favorite', $post->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-warning btn-sm"]) !!}
    {!! Form::close() !!}
@endif