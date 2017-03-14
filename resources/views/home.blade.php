@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    You are logged in!
                </div>
                <div class="panel-heading">Items You Bid For
                    <div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                <th style="padding:5px;"> Item ID </th>
                                <th style="padding:5px;"> Item Description </th>
                                <th style="padding:5px;"> Bid End Date</th>
                                <th style="padding:5px;"> Your Bid </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bids_table as $row)
                                    	<tr>
                                    	@foreach ($row as $col)
                                    		@if ($loop->iteration > 4)

                                    		@elseif($loop->iteration == 1)
                                                <td><a href="update_item?item_id={{$col}}">{{ $col }}</a></td>
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
                <div class="panel-heading">Your Items on Loan
                    <div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                <th style="padding:5px;"> Item ID </th>
                                <th style="padding:5px;"> Item Description </th>
                                <th style="padding:5px;"> Loan Date </th>
                                <th style="padding:5px;"> Return Date </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans_table as $row)
                                    	<tr>
                                    	@foreach ($row as $col)
                                    		@if ($loop->iteration > 4)

                                    		@elseif($loop->iteration == 1)
                                                <td><a href="update_item?item_id={{$col}}">{{ $col }}</a></td>
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

                <div class="panel-heading">Your Items For Bidding
                    <div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                <th style="padding:5px;"> Item ID </th>
                                <th style="padding:5px;"> Item Description </th>
                                <th style="padding:5px;"> Current Highest Bid </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items_table as $row)
                                	<tr>
                                	@foreach ($row as $col)
                                		@if ($loop->iteration > 4)
                                		@elseif($loop->iteration == 1)
                                            <td><a href="update_item?item_id={{$col}}">{{ $col }}</a></td>
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
    </div>
</div>
@endsection
