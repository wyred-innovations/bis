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

	<script src="http://{{$_SERVER['HTTP_HOST']}}/assets/js/plugins/chartJs/Chart.min.js"></script>

	<script type="text/javascript">


		function bargraph(id,dataset){


			var dataoBj =  dataset;
			var div = id;

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

		


			console.log(incomeFinal);

            var barData = {
		        labels: years,
		        datasets: [
		            {
		                label: "Income",
		                fillColor: "rgba(26,179,148,0.5)",
		                strokeColor: "rgba(220,220,220,0.8)",
		                highlightFill: "rgba(220,220,220,0.75)",
		                highlightStroke: "rgba(220,220,220,1)",
		                data: incomeFinal
		            }
		           
		        ]
		    };

		    var barOptions = {
		        scaleBeginAtZero: true,
		        scaleShowGridLines: true,
		        scaleGridLineColor: "rgba(0,0,0,.05)",
		        scaleGridLineWidth: 5,
		        barShowStroke: false,
		        barStrokeWidth: 2,
		        barValueSpacing: 62,
		        barDatasetSpacing: 2,
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
					<h3 class="t-center bold">SACRED HEART OF BUTUAN</h3>
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
		


		<div class="col-md-12 text-center text-primary" style="margin-top: 70px">
			<h4>INCOME AND EXPENSES</h4>
			<label class="text-muted"><u><i>Year Range: <span >{{ $sorter["start"] }} - {{ $sorter["end"] }}</i></u></span></label>

		</div>

		<div class="col-md-12 ">

			

			@if(isset($sorter["show_income"]))
				<div class="text-danger">
					<b><h4>LIST OF INCOMES</h4></b>
				</div>
			@foreach($finalIncomeData as $yearData)
				

				<div class="text-primary">
						<b><h5>{{incomeInfo($yearData)}}</h5></b>
				</div>

				@foreach($yearData as $key => $value)

				

				<div class="form-control text-center " style="background-color:rgb(171, 233, 137)">
					<label style="color: white"><i>{{ $key }}</i></label>
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



				<div class="ibox float-e-margins">
		            <div class="ibox-title">
		                <h5>Barchart</h5>
		                <div ibox-tools></div>
		            </div>
		            <div class="ibox-content">
		                <div class="canvas-holder" style="width: 818px; height: 409px;">
		                    <canvas id="barChart{{$key}}" width="1636" height="818" style="width: 818px; height: 409px;"></canvas>
		                </div>
		            </div>
		        </div>

		        <script type="text/javascript"> 
		        		var id = "barChart{{$key}}";
		        		var dataSet = <?php echo json_encode($yearData) ?>;
		        		bargraph(id,dataSet); 

		        </script>
			@endforeach
			@endif

		
			
	    	@if(isset($sorter["show_expenses"]))
			
		
	    		<div class="text-danger">
					<b><h4>LIST OF EXPENSES</h4></b>
				</div>

			@foreach($finalExpensesData as $person_id => $yearExpensesData)

				<div class="text-primary">
						<b><h5>{{incomeInfo($yearExpensesData)}}</h5></b>
				</div>

				
					@foreach($yearExpensesData as $key => $valueExpense)

				

					<div class="form-control text-center " style="background-color:#DA425A">
						<label style="color: white"><i>{{ $key }}</i></label>
					</div>
					<table class="table  table-condensed table-bordered ">
							<thead>
								<tr>
									<th class="text-center">Expenses Type</th>
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

			function incomeInfo($data){

				foreach ($data as $year => $value) {
					return $value[0]->last_name.", ".$value[0]->first_name." ".$value[0]->middle_name;
				}
				
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

	

</body>

</html>

