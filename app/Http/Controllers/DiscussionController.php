<?php

namespace App\Http\Controllers;

use App\User;
use App\Reply;
use App\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateDiscussionRequest;

class DiscussionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussion = Discussion::filterByChannel()->paginate(3);
        return view('discussions.index', compact('discussion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([

            'title' => $request->title,
            'slug'  => Str::slug($request->title, '-'),
            'content'=> $request->content,
            'channel_id' => $request->channel
        ]);
        
        Session::flash('success', 'Discussion Created !!');
        return redirect()->route('discussion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussions.show', ['discussion' => $discussion]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function bestreply(Discussion $discussion, Reply $replies)
    {
        $discussion->markAsBestReply($replies);

        Session::flash('success', 'Marked as best reply');

        return redirect()->back();
    }

}
