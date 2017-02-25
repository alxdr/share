@extends('template')
@section('main')
<div class="row">
<div class="col-xs-1"></div>
<div class="col-xs-10">
<div class="table-responsive">
<table class="table-striped table-bordered table-hover">
<thead>
<tr>
<th> id </th>
<th> item </th>
<th>availability</th>
</tr>
</thead>
<tbody>
@foreach ($table as $row)
	<tr>
	@foreach ($row as $col)
		@unless ($loop->iteration > 2)
			<td> {{ $col }} </td>
		@endunless
		@if ($loop->iteration == 3)
			@if ($col == 1)
				<td> available </td>
			@else
				<td> unavailable </td>
			@endif
		@endif
	@endforeach
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="col-xs-1"></div>
</div>
@endsection
