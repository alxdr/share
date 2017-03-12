@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="table-responsive">
<h1>Add an Item</h1>
  <form action="add_item_post" method="post">
    {{ csrf_field() }}
  	Item Description: <input type="text" name="description" value=""><br><br>
    Starting Bid: <input type="text" name="starting_bid" value=""><br><br>
    Min Bid Increment: <input type="text" name="min_bid_increment" value=""><br><br>
    Bidding Period:
    <select name="weeks">
      <option name="weeks" value="1">1 Week</option>
      <option name="weeks" value="2">2 Weeks</option>
      <option name="weeks" value="3">3 Weeks</option>
      <option name="weeks" value="4">4 Weeks</option>
  </select><br><br>
  	<input type="submit" value="Add Item">
	</form>
</div>
</div>
<div class="col-xs-1"></div>
</div>
@endsection
