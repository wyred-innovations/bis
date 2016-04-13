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

			
		<div class="col-md-12" >
			<div class="ibox-content">
					<label>INCOME GRAPH</label>
	                <div id="income_graph" style="height: 109px;"  class="ct-perfect-fourth graph"></div>
	        </div>
	    </div>
			

		

	    <div class="col-md-12">
			<div class="ibox-content" >
					<label>EXPENSES GRAPH</label>
	                <div id="expenses_graph" style="height: 109px;"  class="ct-perfect-fourth graph"></div>
	        </div>
	    </div>

	  </div>

	<script src="http://{{$_SERVER['HTTP_HOST']}}/assets/js/plugins/chartist/chartist.min.js"></script>

	<script type="text/javascript">

		var incomeData =  <?php echo json_encode($finalIncomeData) ?>;
		var expensesData =  <?php echo json_encode($finalExpensesData) ?>;
		bargraph("income_graph",incomeData);
		expenses_graph("expenses_graph",expensesData);

		function bargraph(inst,dataoBj){

			var years = [];
			var income = [];
			var expenses = [];
			tempAverage = 0;
			tempAverageExpenses = 0;

			for(i in dataoBj){

				years.push(i)

				for(sub in dataoBj[i]){

					var income_start = dataoBj[i][sub].income_start;
					var income_end = dataoBj[i][sub].income_end;

					if(income_start == "Above "){
						income_start == 7000;
					}

					var tempAverage = (parseFloat(income_start)+parseFloat(income_end))/2;
					income.push(tempAverage);
				}	
				
			}

			
			new Chartist.Bar("#"+inst, {
                labels: years,
                series: [
                    income
                ]
            }, {
                seriesBarDistance: 10,
                reverseData: true,
                horizontalBars: false,
                axisY: {
                    offset: 10
                }
            });

           }




        function expenses_graph(inst2,dataoBj2){

        	var years = [];
			var income = [];
			var expenses = [];
			tempAverage = 0;
			tempAverageExpenses = 0;

			for(s in dataoBj2){

				years.push(i)

				for(sub2 in dataoBj2[s]){

					var expenses_start = dataoBj2[s][sub2].expenses_start;
					var expenses_end = dataoBj2[s][sub2].expenses_end;

					if(expenses_start == "Above "){
						expenses_start == 7000;
					}


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
                horizontalBars: false,
                axisY: {
                    offset: 10
                }
            });
        }


	</script>

</body>

</html>

