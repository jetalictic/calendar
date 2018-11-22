@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color:#1275C9;color:white;"><span>Welcome, {{ Auth::user()->name }}</span>
                <span align="right" style="float:right;">You are now logged in!</span></div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <h4>Notifications</h4>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @if (Auth::user()->user_type == 'admin')
                            <br>Hoowwwddyyy Admin!
                        @elseif (count($tags) == 0)
                            <br>None
                        @else   
                            @foreach ($tags as $tag)
                                <br>User <b>{{ $tag->email }}</b> has added you to the following event: <span style="color:{{  $tag->color }}">{{ $tag->title }}</span>
                                <span style="float:right"><i>{{ $tag->created_at }}</i></span> 
                            @endforeach
                        @endif
                    </div>

                    <a href="/" class="btn m-t-20 btn-primary btn-block waves-effect waves-light fa fa-envelope-o"><span class="col-sm-8" style="font-family: 'Lato', sans-serif;padding-left:16.2px;margin-top:20px;"/>@if( Auth::user()->user_type == "admin")Go To Events Calendar
                    @else Go To My Calendar
                    @endif</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
