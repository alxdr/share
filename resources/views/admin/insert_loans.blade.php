

@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="insert_loan" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="return_date">return_date</label>
    	<input id="return_date" type="datetime" name="return_date" class="form-control">
    </div>
    <div class="form-group>">
    	<label for="loan_date">loan_date</label>
    	<input id="loan_date" type="datetime" name="loan_date" class="form-control">
    </div>
    <div class="form-group>">
	<label for="item_id">item_id</label>
    	<input id="item_id" type="number" min="1" name="item_id" class="form-control">
    </div>
    <div class="form-group>">
	<label for="user_id">user_id</label>
    	<input id="user_id" type="number" min="1" name="user_id" class="form-control">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
