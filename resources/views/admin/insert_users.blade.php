

@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="insert_user" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="email">email</label>
    	<input id="email" type="email" name="email" class="form-control">
    </div>
    <div class="form-group>">
    	<label for="password">password</label>
    	<input id="password" type="password" name="password" class="form-control">
    </div>
    <div class="form-group>">
	<label for="is_admin">is_admin</label>
    	<input id="is_admin" type="number" min="0" max="1" name="is_admin" class="form-control">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
