@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-unstyled">
                @if (!Auth::guest())
                    <a href="" class="btn btn-primary btn-sm">Редактировать профиль</a>
                @endif
                <br>
                <br>
                <li>Имя: {{$user->name}} {{$user->fname}}</li>
                <li>Ник: {{$user->nickname}}</li>
                <li>Пол: {{$user->sex}}</li>
                <li>Город: {{$user->city}}</li>
                <li>Интересы: {{$user->interest}}</li>
                <li>Возраст: {{$user->age}}</li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>Последние посты</h4>
        </div>
    </div>
</div>
@endsection
