
@extends('layouts.app')
@section('content')
<div class="container">
	<ul class="nav nav-pills">
	    <li role="presentation" @if ($active == 'items') class="active" @endif><a href="/admin/1">Items</a></li>
	    <li role="presentation" @if ($active == 'users') class="active" @endif><a href="/admin/2">Users</a></li>
	    <li role="presentation" @if ($active == 'bids') class="active" @endif><a href="/admin/3">Bids</a></li>
	    <li role="presentation" @if ($active == 'loans') class="active" @endif><a href="/admin/4">Loans</a></li>
	</ul>
    <form id="form" action="/edit" method="post">
	{{ csrf_field() }}
	<div class="form-group table-responsive">
	    <table class="table">
		<thead>
		    <tr>
			@foreach ($table as $row)
			@if ($loop->iteration > 1)
			    @break
			@endif
			@foreach ($row as $head => $data)
			<th>{{$head}}</th>
			@endforeach
			<th>update</th>
			<th>delete</th>
			@endforeach
		    </tr>
		</thead>
		<tbody>
		    @foreach ($table as $row)
			<tr>
			@foreach ($row as $head => $data)
			<td>{{$data}}</td>
			@endforeach
			<td><button class="btn btn-primary btn-xs update">update</button></td>
			<td><button class="btn btn-danger btn-xs delete">delete</button></td>
			</tr>
		    @endforeach
		    <tr>
			<td><button class="btn btn-default btn-sm insert">insert</button></td>
		    </tr>
		</tbody>
	    </table>
	    <input id="id" type="hidden" name="id" value="">
	    <input id="submit" type="hidden" name="submit" value="button">
	    <input id="table" type="hidden" name="table" value="{{$active}}">
	</div>
    </form>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
