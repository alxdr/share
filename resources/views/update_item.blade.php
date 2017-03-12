@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="table-responsive">
<h1>Update an Item</h1>
  <form action="update_item_post" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="item_id" value="{{$item_id}}">
    Item Description: <input type="text" name="description" value="{{$row['description']}}"><br><br>
    Min Bid Increment: <input type="text" name="min_bid_increment" value="{{$row['min_bid_increment']}}"><br><br>
    Current Bid End Date: {{$row['bid_end_date']}}<br><br>
    <input type="radio" name="change_date" value="0" checked="checked"> Do not change date<br>
    <input type="radio" name="change_date" value="1"> Alter Bid End Date to be <input type="hidden" name="bid_end_date" value="{{$row['bid_end_date']}}">
    <select name="weeks">
      <option name="weeks" value="1">1 Week</option>
      <option name="weeks" value="2">2 Weeks</option>
      <option name="weeks" value="3">3 Weeks</option>
      <option name="weeks" value="4">4 Weeks</option>
  </select> from now<br><br>
  	<input type="submit" value="Update Item">
	</form>
    <br><br><br>
    <form action="delete_item_post" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="item_id" value="{{$item_id}}">
        <input type="submit" value="Delete Item">
    </form>
</div>
</div>
<div class="col-xs-1"></div>
</div>
@endsection
