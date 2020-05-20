@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible flash">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p>{{ $message }}</p>
</div>
@endif
<div class="card shadow" style="margin-top:52px;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="image-name">
                <img width="40px" height="40px" style="border-radius:50%" class="img-fluid"
                    src="{{Auth::user()->gravatar ?? ''}} ">
                <strong class="ml-2">{{$discussion->user->name}}</strong>
            </div>
            <div class="back">
                <a href="{{route('discussion.index')}}" class="btn btn-dark text-white my-2 shadow">Back</a>
            </div>
        </div>
        <div class="card-body">
            <h4>{{$discussion->title}}</h4>
            <hr>
            {!! $discussion->content !!}

            @if($discussion->bestReply)
            <div class="card text-white bg-success my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="image-name">
                            <img width="40px" height="40px" style="border-radius:50%" class="img-fluid"
                                src="{{Auth::user()->gravatar ?? ''}} ">
                            <strong class="ml-2">{{$discussion->bestReply->user->name}}</strong>
                        </div>
                        <div class="Best Reply">
                            <strong>Best Reply</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $discussion->bestReply->content!!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@foreach($discussion->replies()->paginate(3) as $reply)
<div class="card shadow my-5">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="image-name">
                <img width="40px" height="40px" style="border-radius:50%" class="img-fluid"
                    src="{{Auth::user()->gravatar ?? ''}} ">
                <strong class="ml-2">{{$reply->user->name}}</strong>
            </div>

            @auth

            @if(auth()->user()->id == $discussion->user_id )
            <form action="{{route('discussions.best-reply', ['discussion' => $discussion->slug, 'replies' => $reply->id])}}" method="POST">
                @csrf
                <input type="submit" name="submit" value="Mark As Best Reply" class="btn btn-primary btn-sm shadow"></input>
            </form>
            @endif
            
            @endauth
        </div>
    </div>
    <div class="card-body">
        {!! $reply->content !!}

    </div>
</div>
@endforeach

{{$discussion->replies()->paginate(3)->render()}}

@auth
<div class="card shadow" style="margin-top:52px;">
    <div class="card-header">Add Reply</div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group-item">
                @foreach($errors->all() as $error)
                {{$error}}
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('reply.store', $discussion->slug)}}" method="POST">
            @csrf
            <div class="form-group">
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <button type="submit" class="btn btn-success btn-sm shadow">Submit Reply</button>
        </form>
    </div>
</div>
</div>
@else
<a href="{{route('login')}}" class="btn btn-success my-2 shadow" style="margin-right:70px">SignIn To Add Reply</a>
@endauth

@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix-core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
