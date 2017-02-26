@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">Stuff for Sharing, Borrowing and Lending</div>
<div class="panel-body">
<div class="table-responsive" align="center">
<table class="table-striped table-bordered table-hover">
<thead>
<tr>
<th> id </th>
<th> item </th>
<th>availability</th>
<th>highest_bid</th>
</tr>
</thead>
<tbody>
@foreach ($table as $row)
	<tr>
	@foreach ($row as $col)
		@if ($loop->iteration > 4)
		@elseif ($loop->iteration == 3)
			@if ($col == 1)
				<td> available </td>
			@else
				<td> unavailable </td>
			@endif
		@else
			<td> {{ $col }} </td>

		@endif
	@endforeach
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
