@extends('layouts.app')
@section('content')
<div class="container">
    <h3><strong>Base Statistics</strong></h3>
    <h4>max bid pt in history = {{ $max }}</h4>
    <h4>min bid pt in history = {{ $min }}</h4>
    <h4>mean bid pt in history = {{ $avg_bid }}</h4>
    <h4>total users = {{ $total_users }}</h4>
    <h4>total items = {{ $total_items }}</h4>
    <h4>total bids = {{ $total_bids }}</h4>
    <h4>total loans = {{ $total_loans }}</h4>
    <h3><strong>Top 10 lenders of most popular items</strong></h3>
    <div class="table-responsive">
	<table class="table">
	    <thead>
		<tr>
		    <th>rank</th>
		    <th>user</th>
		    <th>bids count</th>
		</tr>
	    </thead>
	    <tbody>
		@foreach ($pop_result as $pop)
		    <tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $pop->email }}</td>
			<td>{{ $pop->count }}</td>
		    </tr>
		@endforeach
	    </tbody>
	</table>
    </div>
    <h3><strong>Chart Statistics: Number of Bids Per Day</strong></h3>
    <h5>(for past 9 days and today excluding days with 0 bids)</h5>
    <canvas id="chart1" width="400" height="400"></canvas>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@include('admin.chart_script')
@endsection
