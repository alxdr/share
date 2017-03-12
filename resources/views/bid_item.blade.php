@extends('layouts.app')
@section('content')
<div class="container">
    <form action='submit_bid_info' method='post'>
    	{{csrf_field()}}
        Enter Item ID:<br>
        <input type='number' name='bid_item_id' value="{{$item_id}}"><br>
        Enter Bid Value:<br>
        <input type='number' name='bid_item_point' value='' min='1'><br>
        <input type='submit' value='Submit'>
    </form>
</div>
@endsection
