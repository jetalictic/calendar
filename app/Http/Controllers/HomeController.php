<?php

namespace App\Http\Controllers;
use Auth;
use App\Tag;
use App\User;
use App\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $received_events = Tag::select('users.id', 'users.title')
        //     ->Join('events', function($join){
        //         $join->on('events.id', '=', 'tags.event_id')   
        //              ->where('tags.receiver_user_id', '=', Auth::user()->id);
        // })
        // ->groupBy('events.id')->get();

        $tags = Tag::select('users.email' ,'events.title', 'events.color', 'tags.created_at')
            ->Join('events', 'events.id', '=', 'tags.event_id')
            ->Join('users', 'users.id', '=', 'tags.sender_user_id')
            ->where('tags.receiver_user_id', '=', Auth::user()->id)
            ->groupBy('events.id')->get();
            // ->where('users.id', '=', Auth::user()->id)->get();
            // Where users.id = tags.sender_user_id AND events.id = tags.event_id
            // AND receiver_user_id = 1
            // GROUP BY events.id);

        // $tags = Tag::all()->where('receiver_user_id', '=', Auth::user()->id);
        return view('home')->with('tags', $tags);
    }
}
