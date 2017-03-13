
@extends('layouts.app')
@section('content')
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form action="edit_user" method="post">
    {{ csrf_field() }}
    <div class="form-group>">
    	<label for="user_id">user_id</label>
        <input id="user_id" type="number" min="1" name="user_id" class="form-control" value="{{$data[0]->user_id}}" readonly>
    </div>
    <div class="form-group>">
    	<label for="email">email</label>
    	<input id="email" type="email" name="email" class="form-control" value="{{$data[0]->email}}">
    </div>
    <div class="form-group>">
    	<label for="password">password</label>
    	<input id="password" type="password" name="password" class="form-control">
    </div>
    <div class="form-group>">
	<label for="is_admin">is_admin</label>
    	<input id="is_admin" type="number" min="0" max="1" name="is_admin" class="form-control" value="{{$data[0]->is_admin}}">
    </div>
    <br>
    <input type="submit" value="submit">
</form>
</div>
</div>
</div>
@endsection
