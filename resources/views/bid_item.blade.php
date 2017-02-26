@extends('template')
@section('main')
<div class="container">
    <form action='submit_bid_info' method='get'>
        Enter Item ID:<br>
        <input type='number' name='bid_item_id' value=''><br>
        Enter Bid Point:<br>
        <input type='number' name='bid_item_point' value=''><br>
        <input type='submit' value='Submit'>
    </form>
</div>
@endsection