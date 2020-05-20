@extends('layouts.app')

@section('content')

<div class="card shadow" style="margin-top:52px;">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <ul class="list-group">

            @foreach($notifications as $notification)

            <li class="list-group-item">

                @if($notification->type == 'App\Notifications\NewReplyAdded')

                <strong>{{$notification->data['discussion']['title']}}</strong>

                <a href="{{route('discussion.show', $notification->data['discussion']['slug'])}}"
                    class="btn float-right btn-sm btn-info text-white"> View Discussion</a>

                @endif

                @if($notification->type == 'App\Notifications\MarkAsBestReply')

                Your reply to the discussion <strong>{{$notification->data['discussion']['title']}}</strong> mark as best reply!!

                <a href="{{route('discussion.show', $notification->data['discussion']['slug'])}}"
                    class="btn float-right btn-sm btn-info text-white"> View Discussion</a>

                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
