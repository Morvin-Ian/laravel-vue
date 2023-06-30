@extends('layout')
@section('content')
    @foreach($posts as $post)
        <article>
            <h1>
                <a href="{{ route ('post', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h1>

            <p>
                By <a href="{{route ('author',$post->author->name) }}"> {{ $post->author->name }}</a> in <a href="{{ route ('category', $post->category->slug)}}">{{ $post->category->name }}</a>
            </p>

            <div>
                {{  $post->excerpt  }}
            </div>
        </article>
    @endforeach
@endsection