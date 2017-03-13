@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="edit_item" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="item_id">item_id</label>
        <input id="item_id" type="number" min="1" name="item_id" class="form-control" value="{{$data[0]->item_id}}" readonly>
    </div>
    <div class="form-group>">
    	<label for="desc">description</label>
    	<input id="desc" type="text" name="description" class="form-control" value="{{$data[0]->description}}">
    </div>
    <div class="form-group>">
    	<label for="avail">availability</label>
    	<input id="avail" type="number" min="0" max="1" name="availability" class="form-control" value="{{$data[0]->availability}}">
    </div>
    <div class="form-group>">
	<label for="bed">bid_end_date</label>
    	<input id="bed" type="datetime" name="bid_end_date" class="form-control" value="{{$data[0]->bid_end_date}}">
    </div>
    <div class="form-group>">
	<label for="bsd">bid_start_date</label>
    	<input id="bsd" type="datetime" name="bid_start_date" class="form-control" value="{{$data[0]->bid_start_date}}">
    </div>
    <div class="form-group>">
	<label for="sb">starting_bid</label>
    	<input id="sb" type="number" min="1" name="starting_bid" class="form-control" value="{{$data[0]->starting_bid}}">
    </div>
    <div class="form-group>">
	<label for="mbi">min_bid_increment</label>
    	<input id="mbi" type="number" min="1" name="min_bid_increment" class="form-control" value="{{$data[0]->min_bid_increment}}">
    </div>
    <div class="form-group>">
	<label for="hbi">highest_bid_id</label>
    	<input id="hbi" type="number" min="1" name="highest_bid_id" class="form-control" value="{{$data[0]->highest_bid_id}}">
    </div>
    <div class="form-group>">
	<label for="owner">owner</label>
    	<input id="owner" type="number" min="1" name="owner" class="form-control" value="{{$data[0]->owner}}">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
