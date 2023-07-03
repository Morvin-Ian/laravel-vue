@extends('components/layout')
@section('content')
@include('components/_navbar')

<div class="container-fluid">
    <h4>Blog Posts</h4>
    @foreach($posts as $key => $post)
        <article>
                <a class="text-dark" href="{{ route ('post', $post->slug) }}">
                    <h6>{{$key + 1}}. {{ $post->title }}</h6>
                </a>

            <p>
                {{-- By <a href="{{route ('author',$post->author->name) }}"> {{ $post->author->name }}</a> in <a href="{{ route ('category', $post->category->slug)}}">{{ $post->category->name }}</a> --}}
            </p>

            <div>
                {{-- {{  $post->excerpt  }} --}}
            </div>
        </article>
    @endforeach
</div>

@endsection