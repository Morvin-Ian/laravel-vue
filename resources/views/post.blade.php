@extends('layout')
@section('content')

    <article>
            <h1>{{ $post->title }}</h1>
            <p>
                By <a href="{{route ('author',$post->author->name) }}">{{ $post->author->name }}</a> in <a href="{{ route ('category', $post->category->slug)}}">{{ $post->category->name }}</a>
            </p>

            <div>
                {{ $post->body }}
            </div>

    </article>

    <a href="{{route ('posts')}}">Go back</a>


@endsection
