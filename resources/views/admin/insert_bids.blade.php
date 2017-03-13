

@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="insert_bid" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="item_id">item_id</label>
    	<input id="item_id" type="number" min="1" name="item_id" class="form-control">
    </div>
    <div class="form-group>">
    	<label for="bidder">bidder</label>
    	<input id="bidder" type="number" min="1" name="bidder" class="form-control">
    </div>
    <div class="form-group>">
	<label for="bid_value">bid_value</label>
    	<input id="bid_value" type="number" name="bid_value" class="form-control">
    </div>
    <div class="form-group>">
	<label for="bid_time">bid_time</label>
    	<input id="bid_time" type="datetime" name="bid_time" class="form-control">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
