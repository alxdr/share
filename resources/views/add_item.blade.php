@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="table-responsive">
<h1>Add an Item</h1>
  <form action="add_item_post" method="get">
  	Description:<br>
  	<input type="text" name="description" value=""><br>
  	Owner:<br>
  	<input type="text" name="owner" value=""><br><br>
  	<input type="submit" value="Add Item">
	</form>
</div>
</div>
<div class="col-xs-1"></div>
</div>
@endsection
