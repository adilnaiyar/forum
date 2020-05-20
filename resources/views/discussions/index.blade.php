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

@foreach($discussion as $dis)
<div class="card shadow" style="margin-bottom: 40px;">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="image-name">
                <img width="40px" height="40px" style="border-radius:50%" class="img-fluid"
                    src="{{Auth::user()->gravatar?? ''}}">
                <strong class="ml-2">{{$dis->user->name}}</strong>
            </div>
            <div class="add discussion">
                <a href="{{route('discussion.show', $dis->slug)}}" class="btn btn-info text-white my-2 shadow">Read
                    More</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h4>{{$dis->title}}</h4>
        <hr>
        {!! Str::limit($dis->content,500) !!}
    </div>
</div>
@endforeach

{{$discussion->appends(['channel' => request()->query('channel') ])->render()}}

@endsection
