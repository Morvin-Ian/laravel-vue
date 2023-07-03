@extends('components/layout')
@section('content')
@include('components/_navbar')

    <div class="container">
            <h1>{{ $post->title }}</h1>
            <p>
            </p>

            <div>
                {{ $post->body }}
            </div>

            <a href="{{route ('posts')}}">Go back</a>


    </div >



@endsection
