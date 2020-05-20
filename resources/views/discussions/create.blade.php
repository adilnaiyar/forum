@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header">Add Discussion</div>

    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group-item">
                @foreach($errors->all() as $error)
                <li class="list-group-item">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('discussion.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="title" value="" placeholder="Title" class="form-control">
            </div>
            <div class="form-group">
                <input id="content" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <select name="channel" id="channel" class="form-control">
                    @foreach($channels as $channel)
                    <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create Discussion</button>
        </form>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix-core.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
@endsection
