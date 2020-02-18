@extends('layouts.app')

@section('content')
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            @if (count($posts) > 0)
                @include('favorites.favorite_check', ['posts' => $posts])
            @endif
        </div>
@endsection