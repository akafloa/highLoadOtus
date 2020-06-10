@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="card m-0">

                    <!-- Row start -->
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                            <div class="users-container">
                                <div class="chat-search-box">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                               
                                @if($friends)
                                    <ul class="users">
                                        @foreach($friends as $friend)
                                            <li class="person" data-user="{{$friend->follow_id}}">
                                                <div class="user">
                                                    <img src="{{$friend->avatar}}" >
                                                    <!--<span class="status busy"></span>-->
                                                </div>
                                                <p class="name-time">
                                                    <span class="name">{{$friend->name}} {{$friend->fname}}</span>
                                                    <!--<span class="time">15/02/2019</span>-->
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                        @if($toUser)
                            <div class="selected-user">
                                <span>To: <span class="name">{{$toUser->name}} {{$toUser->fname}}</span></span>
                            </div>
                            <div class="chat-container">
                                <ul class="chat-box chatContainerScroll" style="height: 300px !important; overflow-y: scroll; padding-right: 20px;">
                                    @foreach($messages as $message)
                                        @if($message->from_id != $userId)
                                            <li class="chat-left">
                                                <div class="chat-avatar">
                                                    <img src="{{$message->from_avatar}}" alt="Retail Admin">
                                                    <div class="chat-name">{{$message->from_name}}</div>
                                                </div>
                                                <div class="chat-text">{{$message->message}}</div>
                                                <div class="chat-hour">{{$message->created_time}} <!-- <span class="fa fa-check-circle"></span> --></div>
                                            </li>
                                        @else
                                            <li class="chat-right">
                                                <div class="chat-hour">{{$message->created_time}} <!-- <span class="fa fa-check-circle"></span> --></div>
                                                <div class="chat-text">{{$message->message}}</div>
                                                <div class="chat-avatar">
                                                    <img src="{{$message->from_avatar}}" alt="Retail Admin">
                                                    <div class="chat-name">{{$message->from_name}}</div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="form-group mt-3 mb-0">
                                    <form method="POST" action="{{route('send')}}" id="msg-form">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$userId}}" />
                                        <input type="hidden" name="to" value="{{$toUser->id}}" />
                                        <textarea class="form-control" id="msg-input" name="message" rows="3" placeholder="Type your message here..." ></textarea>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- Row end -->
                </div>

            </div>

        </div>
        <!-- Row end -->
   
</div>
@endsection
