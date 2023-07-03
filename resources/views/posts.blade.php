@extends('components/layout')
@section('content')
@include('components/_navbar')

<div class="container-fluid">
    <h4 class="mt-4">Blog Posts</h4>
    @unless (count($posts)==0)

        @foreach($posts as $key => $post)
                
        @php
            $author = \App\Models\User::find($post->author);
        @endphp
        
        <article>
            <div>
                <a class="text-dark" href="{{ route ('post', $post->slug) }}"><h6 style="font-weight: bold">{{$key + 1}}. {{ $post->title }} <small>(Written - {{$post->created_at->diffForHumans()}})</small></h6> </a>
                <small>Author: {{$author->name}}</small>
                <p>{{Str::limit($post->body, 200)}}</p>

            </div>
        </article>
        <hr>
        @endforeach

        <p>{{$posts->links()}}</p>
    @else
        <p class="lead">No Blogs Available</p>
            
    @endunless
  
</div>

@endsection