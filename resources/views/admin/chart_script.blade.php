<script type="text/javascript">
var ctx1 = document.getElementById("chart1");
var data1 = {
    labels: [
	/*@for ($i = $days; $i >= 0; $i--)
	    {{$i}}
	    @unless ($i == 0)
		,
	    @endunless
	@endfor*/
	@foreach($data as $key => $val)
	    @if ($key == 0)
	 	'today'
	    @else
	        {{$key}}
	    @endif
	    @unless ($loop->last)
		,
	    @endunless
	@endforeach
    ],
    datasets: [
	{
	    label: "no. of bids per day",
	    fill: false,
	    lineTension: 0.1,
	    backgroundColor: "rgba(255, 255, 255, 0.4)",
	    borderColor: "rgba(255, 99, 132,, 0.2)",
	    borderCapStyle: "butt",
	    borderDash: [],
	    borderDashOffset: 0.0,
	    borderJoinStyle: "mitter",
	    pointBorderColor: "rgba(75, 192, 192, 1)",
	    pointBackgroundColor: "#fff",
	    pointBorderWidth: 1,
	    pointHoverRadius: 5,
	    pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
	    pointHoverBorderColor: "rgba(220, 220, 220, 1)",
	    pointHoverBorderWidth: 2,
	    pointRadius: 1,
	    pointHitRadius: 10,
	    data: [
		@foreach ($data as $key => $val)
		    {{ $val }}
		    @unless ($loop->last)
		    ,
		    @endunless
		@endforeach
	    ],
	    spanGaps: false,
	    hidden: false
	}	
    ]
}; 
var chart1 = new Chart(ctx1, {
    type: 'line',
    data: data1,
    options: {
	title: {
	    display: true,
	    text: 'avg no. of bids = {{$avg}}'
	},
	responsive: true,
	scales: {
	    xAxes: [{
		scaleLabel: {
		    display: true,
		    labelString: 'days ago'
		}
	    }]
	}
    }
});
</script>
