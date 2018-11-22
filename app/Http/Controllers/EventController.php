<?php

namespace App\Http\Controllers;
use Auth;
use App\Event;
use App\User;
use App\Tag;
use App\Mail\EventSchedule;
use Maddlatter\LaravelFullcalendar\Facades\Calendar;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = [];

        if(Auth::user()->user_type == "admin") $events = Event::all();
        else{
            $events = Event::all()->where('user_id', '=', Auth::user()->id);

            // $tagged_events = Event::leftJoin('tags', 'tags.receiver_user_id', '=', 'events.user_id')
            // ->where('tags.receiver_user_id', '2')
            // ->groupBy('events.id')->get();

            $tagged_events = Tag::select('events.id', 'events.user_id', 'events.title', 'events.color', 'events.start_date', 'events.end_date', 'events.description', 'events.comment', 'events.participants', 'events.created_at', 'events.updated_at')
                ->Join('events', function($join){
                    $join->on('events.id', '=', 'tags.event_id')    
                         ->where('tags.receiver_user_id', '=', Auth::user()->id);
            })
            ->groupBy('events.id')->get();

            foreach($tagged_events as $tagged_event){
                $enddate = $tagged_event->end_date."24:00:00";
                $event[] = \Calendar::event(
                $tagged_event->title,
                false,
                new \DateTime($tagged_event->start_date),
                new \DateTime($tagged_event->end_date),
                $tagged_event->id,
                [
                    'color' => $tagged_event->color,
                    'description' => $tagged_event->description,
                    'comment' => $tagged_event->comment,
                    'participants' => $tagged_event->participants,
                ]
            );
            }
        } 

        // //testing
        // $tags = [];
        // //$ids = [];
        // for ($i=1; $i == Event::count(); $i++) { 
        //     //get data row by row
        //     $row = Event::find($i);

        //     //get tags column values in current row
        //     $tag = $row->tags;

        //     //store data into $ids array variable if the current user is tagged in the specific event
        //     $taggedevent = explode(',',$tag);
        //     if (in_array(Auth::user()->id, $taggedevent)) {
        //       $events[] = Event::find($i);
        //     }
        // }
        // //$events = Event::all();
        foreach($events as $row){
            $enddate = $row->end_date."24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $row->color,
                    'description' => $row->description,
                    'comment' => $row->comment,
                    'participants' => $row->participants,
                ]
            );
        }
        $calendar = \Calendar::addEvents($event)->setOptions([
        'eventTextColor' => '#fff',
        'borderColor' => '#000',
        ])->setCallbacks(['eventRender' => 'function(event, element){element.attr(\'href\', \'javascript:void(0);\');}', 'eventClick' => 'function(event, jsEvent, view) {
                    $(\'#eventTitle\').html(event.title);
                    $(\'#eventDescription\').html(event.description);
                    $(\'#eventComment\').html(event.comment);
                    $(\'#eventStartDate\').html(event.start.format("MM/DD/YYYY h:mm a"));
                    $(\'#eventEndDate\').html(event.end.format("MM/DD/YYYY h:mm a"));
                    $(\'#myModal\').modal();
            }']);
        return view('eventpage', compact('events', 'calendar'));
    }

    public function index2()
    {
        $events = Event::all()->where('user_type', '=', 'admin');
        $event = [];
        
        foreach($events as $row){
            $enddate = $row->end_date."24:00:00";
            $event[] = \Calendar::event(
                $row->title,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'color' => $row->color,
                    'description' => $row->description,
                    'comment' => $row->comment,
                    'participants' => $row->participants,
                ]
            );
        }

        $calendar = \Calendar::addEvents($event)->setOptions([
        'eventTextColor' => '#fff',
        'borderColor' => '#000',
        'aspectRatio' => '1',
        'contentHeight' => 'auto',
        ])->setCallbacks(['eventRender' => 'function(event, element){element.attr(\'href\', \'javascript:void(0);\');}', 'eventClick' => 'function(event, jsEvent, view) {
                    $(\'#eventTitle\').html(event.title);
                    $(\'#eventDescription\').html(event.description);
                    $(\'#eventComment\').html(event.comment);
                    $(\'#eventStartDate\').html(event.start.format("MM/DD/YYYY h:mm a"));
                    $(\'#eventEndDate\').html(event.end.format("MM/DD/YYYY h:mm a"));
                    $(\'#myModal\').modal();
        }']);
        return view('events', compact('events', 'calendar'));
    }

    public function sendemail(Request $request, $id){
        $this->validate($request,[
            'receiver_id' => 'required',
        ]);

        $events = Event::find($id);

        $title = $events->title;
        $color = $events->color;
        $startdate = $events->start_date;
        $enddate = $events->end_date;

        foreach($request->get('receiver_id') as $ids){
            $tags = new Tag;
            $tags->event_id = $id;
            $tags->sender_user_id = Auth::user()->id;
            $tags->receiver_user_id = $ids; 
            $tags->save();

            $receiver = User::find($ids);
            $email = $receiver->email;

            \Mail::to($email)->send(new EventSchedule($events));
        }
        return redirect('events')->with('success', 'Mail Sent!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function display(){
        return view('addevent');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'comment' => 'required',
            'participants' => 'required',
        ]);

        $events = new Event;
        
        $events->user_id = Auth::user()->id;
        $events->title = $request->input('title');
        $events->color = $request->input('color');
        $events->start_date = $request->input('start_date');
        $events->end_date = $request->input('end_date');
        $events->description = $request->input('description');
        $events->comment = $request->input('comment');
        $events->participants = $request->input('participants');

        $events->save();

        return redirect('events')->with('success', 'Event Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::user()->user_type == "admin") $events = Event::all();
        else $events = Event::all()->where('user_id', '=', Auth::user()->id);
        //$events = Event::all();
        return view('display')->with('events', $events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = Event::find($id);
        return view('editform', compact('events', 'id'));
    }

    public function senddata($id)
    {
        $events = Event::find($id);

        $items = User::where('id', '<>', Auth::user()->id)->pluck('email', 'id');
        return view('sendform', compact('events', 'id', 'items'));
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
        $this->validate($request,[
            'title' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'comment' => 'required',
            'participants' => 'required',
        ]);

        $events = Event::find($id);

        $events->title = $request->input('title');
        $events->color = $request->input('color');
        $events->start_date = $request->input('start_date');
        $events->end_date = $request->input('end_date');
        $events->description = $request->input('description');
        $events->comment = $request->input('comment');
        $events->participants = $request->input('participants');

        $events->save();

        return redirect('events')->with('success', 'Event Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Event::find($id);
        $events->delete();

        return redirect('events')->with('success', 'Event Deleted');
    }    
}
