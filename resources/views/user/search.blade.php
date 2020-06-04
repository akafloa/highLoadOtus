@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="GET">
                <div class="form-group">
                    <label for="exampleInputEmail1">Input name</label>
                    <input type="text" name="name" class="form-control" id="search" placeholder="name">
                </div>
                <button type="submit" class="btn btn-primary">Seacrh</button>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        @if($users)
            Find {{$users}} users
        @else
            @if($search)
                Не найдены пользователи
            @endif
        @endif
    </div>
</div>
@endsection
