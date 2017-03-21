
@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Items for Loan</h1>
	<table class="table">
<thead>
		<tr>
	@foreach ($bid_end_table as $row)
	@if ($loop->iteration > 1)
			@break
	@endif
	@foreach ($row as $head => $data)
	<th>{{$head}}</th>
	@endforeach
	<th>update</th>
	@endforeach
		</tr>
</thead>
<tbody>
		@foreach ($bid_end_table as $row)
	<tr>
	@foreach ($row as $head => $data)
	@if($head == 'item_id') {{$id = $data}}
	@endif
	<td>{{$data}}</td>
	@endforeach
	<td><a href = "admin_update_end_bid?item_id={{$id}}"><button class="btn btn-primary btn-xs update">update</button></a></td>
	</tr>
		@endforeach
</tbody>
	</table>

<h1>Items with Expired Loan</h1>
	<table class="table">
<thead>
		<tr>
	@foreach ($loan_end_table as $row)
	@if ($loop->iteration > 1)
			@break
	@endif
	@foreach ($row as $head => $data)
	<th>{{$head}}</th>
	@endforeach
	<th>update</th>
	@endforeach
		</tr>
</thead>
<tbody>
		@foreach ($loan_end_table as $row)
	<tr>
	@foreach ($row as $head => $data)
	@if($head == 'loan_id') {{$id = $data}}
	@endif
	<td>{{$data}}</td>
	@endforeach
	<td><a href = "admin_update_end_loan?loan_id={{$id}}"><button class="btn btn-primary btn-xs update">update</button></a></td>
	</tr>
		@endforeach
</tbody>
	</table>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
