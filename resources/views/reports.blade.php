@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                @if($data)
                    <h4>Время генерации отчета: {{$time}} сек.</h4>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Пол</th>
                                <th>Возраст</th>
                                <th>Кол-во записей</th>
                            </tr>
                        </thead>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$d->sex}}</td>
                                <td>{{$d->age}}</td>
                                <td>{{$d->cnt}}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection