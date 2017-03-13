
@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="edit_bid" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="bid_id">bid_id</label>
        <input id="bid_id" type="number" min="1" name="bid_id" class="form-control" value="{{$data[0]->bid_id}}" readonly>
    </div>
    <div class="form-group>">
    	<label for="item_id">item_id</label>
    	<input id="item_id" type="number" min="1" name="item_id" class="form-control" value="{{$data[0]->item_id}}">
    </div>
    <div class="form-group>">
    	<label for="bidder">bidder</label>
    	<input id="bidder" type="number" min="1" name="bidder" class="form-control" value="{{$data[0]->bidder}}">
    </div>
    <div class="form-group>">
	<label for="bid_value">bid_value</label>
    	<input id="bid_value" type="number" name="bid_value" class="form-control" value="{{$data[0]->bid_value}}">
    </div>
    <div class="form-group>">
	<label for="bid_time">bid_time</label>
    	<input id="bid_time" type="datetime" name="bid_time" class="form-control" value="{{$data[0]->bid_time}}">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
