<!DOCTYPE html>
<html>
	<head>
		<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('/assets/css/custom/rhitsReports.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
		<link href="http://{{$_SERVER['HTTP_HOST']}}/assets/css/plugins/chartist/chartist.min.css" rel="stylesheet">
		<style type="text/css">

				.table > thead > tr > th {
				  border-bottom: 1px solid #DDDDDD;
				  vertical-align: bottom;
				 }

				 .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
				  background-color: #F5F5F6;
				  border-bottom-width: 1px;
				}

		</style>
		<title>INCOME AND EXPENSES</title>
	</head>

	<script src="http://{{$_SERVER['HTTP_HOST']}}/assets/js/plugins/chartJs/Chart.min.js"></script>

<body>
<script type="text/javascript">
	
</script>
	<div class="page-num">Page 1</div>
	<div class="body-legal col-100" >
		<div class ="header col-md-12">
			<div class="col-md-12" style="margin-top: 0px">
				<img src="http://{{$_SERVER['HTTP_HOST']}}/assets/img/logo.png" height="30px" width= "auto">
			</div>
			<div class="col-md-12">
					<h3 class="t-center bold">SACRED HEART OF BUTUAN</h3>
					<p class="t-center">J.C Aquino Ave. Butuan City</p>
			</div>
			
		</div>



		<div class="col-md-12" style="margin-top: 70px">
			<div class="col-md-12">
				<h4 class="t-center">INCOME AND EXPENSES</h4>
			</div>
		</div>

		
		@foreach($finalIncomeData as $income)

		

		{{dd($finalIncomeData)}};
		<div class="col-md-12" style="margin-top: 70px">
			<div class="ibox float-e-margins">
	           	<label>Full Name: {{ $income[0]->last_name }}, {{ $income[0]->first_name }} {{ $income[0]->middle_name }}</label>
	            <div class="ibox-content">	

	                <table class="table table-bordered">
	                    <thead>
	                    <tr>
	                        <th class="t-center">#Id</th>
	                        <th class="t-center">Year</th>
	                        <th class="t-center">Ave. Total Value</th>
	                        <th class="t-center">Percentage</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($income as $key => $persons)
	                    <tr>
	                        <td>000-{{$persons->year}}</td>
	                        <td>{{$persons->year}}</td>
	                        <td>Otto</td>
	                        <td>@mdo</td>
	                   	</tr>
	                	@endforeach

	                    </tbody>
	                </table>

	            </div>
	        </div>
        </div>


        @endforeach







	</div>

</body>

</html>

