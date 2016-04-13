<!DOCTYPE html>
<html>
	<head>
		<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('/assets/css/custom/rhitsReports.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
		<link href="http://{{$_SERVER['HTTP_HOST']}}/assets/css/plugins/chartist/chartist.min.css" rel="stylesheet">
		<style type="text/css">


		</style>
		<title>INCOME AND EXPENSES</title>
	</head>
<body>
<script type="text/javascript">
	
</script>
	<div class="page-num">Page 1</div>
	<div class="body-legal col-100" >
		<div class ="header col-md-12">
			<div class="col-md-3" style="margin-top: 0px">
				<img src="http://{{$_SERVER['HTTP_HOST']}}/assets/img/logo.png" height="30px" width= "auto">
			</div>
			<div class="col-md-7">
					<h4 class="t-center bold">SACRED HEART BUTUAN</h4>
					<p class="t-center">J.C Aquino Ave. Butuan City</p>
			</div>
			
		</div>

		
		<!-- <div class="col-md-12">
			<div class = "form-group">
				<label>Sorted Category: <span class="text-primary">{{$sorter["type"]}}</span></label>
			</div>
			<div class = "form-group">
				<label>Sorted: <span class="text-primary">Sort</span></label>
			</div>
			<div class = "form-group">
				<label>Sort type: <span class="text-primary">Sort</span></label>
			</div>

		</div>
			 -->
		


		<div class="col-md-12 text-center text-primary">
			<h3>INCOME AND EXPENSES</h3>
			<label class="text-muted"><u><i>Year Range: <span >{{ $sorter["start"] }} - {{ $sorter["end"] }}</i></u></span></label>

		</div>

		<div class="col-md-12 ">

			

			@if(isset($sorter["show_income"]))
			<div class="text-success">
				<b><h4>LIST OF INCOMES</h4></b>
			</div>

			@foreach($finalIncomeData as $key => $value)
			<div class="form-control text-center " style="background-color:rgb(171, 233, 137)">
				<label class=""><i>{{ $key }}</i></label>
			</div>
			<table class="table  table-condensed table-bordered ">
					<thead>
						<tr>
							<th class="text-center">Income Type</th>
							<th class="text-center">Rates</th>
							<th class="text-center">Ave. Value</th>
						</tr>
					</thead>
					
					<tbody>
						@foreach($value as $data)
						<tr>
							<td>{{ $data->income_item }}</td>
							<td>{{ $data->income_range }}</td>

							<td>
								Php {{averageIncome($data)}}.00
							</td>

							
						</tr>
						@endforeach

					</tbody>

					


			</table>


			<div class="col-md-12" style="margin-bottom: 50px">
				<div class="pull-right">
						<label class="text-danger">Total: Php {{ number_format(subtotalIncome($value)) }}.00</label>
				</div>
			</div>

			@endforeach
			@endif

		
			
	    	@if(isset($sorter["show_expenses"]))
			<div class="text-danger">
				<b><h4>LIST OF EXPENSES</h4></b>
			</div>

			@foreach($finalExpensesData as $key => $valueExpense)
			<div class="form-control text-center " style="background-color:rgb(171, 233, 137)">
				<label class=""><i>{{ $key }}</i></label>
			</div>
			<table class="table  table-condensed table-bordered ">
					<thead>
						<tr>
							<th class="text-center">Income Type</th>
							<th class="text-center">Rates</th>
							<th class="text-center">Ave. Value</th>
						</tr>
					</thead>
					
					<tbody>
						@foreach($valueExpense as $dataExpenses)
						<tr>
							<td>{{ $dataExpenses->expenses_item }}</td>
							<td>{{ $dataExpenses->expenses_range }}</td>

							<td>
								Php {{averageExpenses($dataExpenses)}}.00
							</td>

							
						</tr>
						@endforeach

					</tbody>

					
			</table>


			<div class="col-md-12" style="margin-bottom: 50px">
				<div class="pull-right">
						<label class="text-danger money">Total: Php {{ number_format(subtotalExpenses($valueExpense)) }}</label>
				</div>
			</div>
			@endforeach
			@endif
		</div>



	    <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Barchart</h5>
                <div ibox-tools></div>
            </div>
            <div class="ibox-content">
                <div class="canvas-holder" style="width: 818px; height: 409px;">
                    <canvas id="barChart" width="1636" height="818" style="width: 818px; height: 409px;"></canvas>
                </div>
            </div>
        </div>
	<?php

			$subtotal = 0;
		
			function subtotalIncome($data){

				$total = 0;

				foreach ($data as $value) {
					$sub = averageIncome($value);
					$total += $sub;
				}
				
				return $total;
			}

			function averageIncome($data){

				if($data->income_start == "Above "){
					$data = 7000;
				}else{
					$data = ($data->income_start + $data->income_end) /2;
				}
				

				return $data;
			}

			function subtotalExpenses($data){

				$total = 0;

				foreach ($data as $value) {
					$sub = averageExpenses($value);
					$total += $sub;
				}
				
				return $total;
			}

			function averageExpenses($dataEx){


				if($dataEx->expenses_start == "Above "){

					$dataEx = 7000;
				}
				else{

					$dataEx = ($dataEx->expenses_start + $dataEx->expenses_end) /2;

				}

				return $dataEx;
			}
	?>

	<script src="http://{{$_SERVER['HTTP_HOST']}}/assets/js/plugins/chartJs/Chart.min.js"></script>

	<script type="text/javascript">

		
		bargraph();


		function bargraph(){


			var dataoBj =  <?php echo json_encode($finalIncomeData) ?>;
			var dataoBj2 =  <?php echo json_encode($finalExpensesData) ?>;
			var div = "barChart";

			var years = [];

			var income = 0;
			var incomeFinal = [];

			var expenses = 0;
			var expensesFinal = [];


			tempAverage = 0;
			tempAverageExpenses = 0;
			tempAverageExpenses = 0;

			for(i in dataoBj){

				years.push(i)

				for(sub in dataoBj[i]){
					var income_start = dataoBj[i][sub].income_start;
					var income_end = dataoBj[i][sub].income_end;

					if(income_start == "Above "){
						income_start = 7000;
					}

					var tempAverage = (parseFloat(income_start)+parseFloat(income_end))/2;
					income += tempAverage;
				}	

				incomeFinal.push(income);
				income = 0;
			}

			for(s in dataoBj2){


				for(sub2 in dataoBj2[s]){

					var expenses_start = dataoBj2[s][sub2].expenses_start;
					var expenses_end = dataoBj2[s][sub2].expenses_end;

					if(expenses_start == "Above "){
						expenses_start = 7000;
					}

					var tempAverageExpenses = (parseFloat(expenses_start)+parseFloat(expenses_end))/2;
					expenses += tempAverageExpenses;
				}	

				expensesFinal.push(expenses);
				expenses = 0;
			}


			console.log(incomeFinal);

            var barData = {
		        labels: years,
		        datasets: [
		            {
		                label: "My First dataset",
		                fillColor: "rgba(26,179,148,0.5)",
		                strokeColor: "rgba(220,220,220,0.8)",
		                highlightFill: "rgba(220,220,220,0.75)",
		                highlightStroke: "rgba(220,220,220,1)",
		                data: incomeFinal
		            },
		            {
		                label: "My Second dataset",
		                fillColor: "#C90887",
		                strokeColor: "rgba(26,179,148,0.8)",
		                highlightFill: "rgba(26,179,148,0.75)",
		                highlightStroke: "rgba(26,179,148,1)",
		                data:expensesFinal
		            }
		        ]
		    };

		    var barOptions = {
		        scaleBeginAtZero: true,
		        scaleShowGridLines: true,
		        scaleGridLineColor: "rgba(0,0,0,.05)",
		        scaleGridLineWidth: 1,
		        barShowStroke: true,
		        barStrokeWidth: 2,
		        barValueSpacing: 5,
		        barDatasetSpacing: 1,
		        responsive: true,
		    }


		    var ctx = document.getElementById(div).getContext("2d");
		    var myNewChart = new Chart(ctx).Bar(barData, barOptions);

           }




        function expenses_graph(inst2,dataoBj2){

        	var years = [];
			var income = [];
			var expenses = [];
			tempAverage = 0;
			tempAverageExpenses = 0;

			for(s in dataoBj2){

				years.push(s)

				for(sub2 in dataoBj2[s]){

					var expenses_start = dataoBj2[s][sub2].expenses_start;
					var expenses_end = dataoBj2[s][sub2].expenses_end;
					var tempAverageExpenses = (parseFloat(expenses_start)+parseFloat(expenses_end))/2;
					expenses.push(tempAverageExpenses);
				}	

				
			}

        	new Chartist.Bar("#"+inst2, {
                labels: years,
                series: [
                    expenses
                ]
            }, {
                seriesBarDistance: 4,
                reverseData: true,
                horizontalBars: true,
                axisY: {
                    offset: 10
                }
            });
        }


	</script>

</body>

</html>

