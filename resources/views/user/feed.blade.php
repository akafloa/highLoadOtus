@extends('layouts.app')

@section('content')
<div class="container">
    @if($posts)
    @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{$post->post_id}} {{$post->title}}</h3>
            <p>{{$post->description}}</p>
        </div>
    </div>
    <hr>
    @endforeach
    @endif
</div>
@endsection
