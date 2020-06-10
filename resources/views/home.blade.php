@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('user_profile', Auth::user()->nickname) }}">My Profile</a>
                    <br><br>
                    <a href="{{ route('message') }}">Messages</a>
                    <br><br>
                    <a href="{{ route('feed') }}">Feed</a>
                    <br><br>
                    <a href="{{ route('user_search') }}">Search User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
