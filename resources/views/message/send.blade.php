
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
	<ul class="nav nav-pills">
	    <li role="presentation"><a href="message">Inbox</a></li>
	    <li role="presentation" class="active"><a href="send">Send Message</a></li>
	</ul>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send Message</div>
                <div class="panel-body">
    		    <form action='send' method='post'>
			{{ csrf_field() }}
			<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" class="form-control"><br>
			<label for="message">Message</label>
			<textarea class="form-control" rows="3" name="message" id="message"></textarea><br>
			<input type="submit" value="Submit">
			</div>
    		    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
