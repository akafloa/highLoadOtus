@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{$post->title}}</h3>
            <p>{{$post->description}}</p>
        </div>
    </div>
    <hr>
    @endforeach
</div>
@endsection
