
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	<ul class="nav nav-pills">
	    <li role="presentation" class="active"><a href="message">Inbox</a></li>
	    <li role="presentation"><a href="send">Send Message</a></li>
	</ul>
	@foreach ($conversations as $email => $convo)
	<div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$email}}</div>
                    <div class="panel-body">
			@foreach ($convo as $msg)
			@if ($msg->email == Auth::user()->email)
			    <blockquote>
				<p>{{$msg->message}}</p>
				<footer>{{$msg->email}}</footer>
			    </blockquote>
			@else
			    <blockquote class="blockquote-reverse">
				<p>{{$msg->message}}</p>
				<footer>{{$msg->email}}</footer>
			    </blockquote>
			@endif
			@endforeach
                    </div>
            	    </div>
            	</div>
            </div>
	</div>
	@endforeach
    </div>
</div>
@endsection
