@extends('bis.main.index')

@section('content')

<div class="row">
           
            <div class="col-lg-6">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Current Members</span>
                            <h2 class="font-bold">{{count($members)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-university fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Current Organizations </span>
                            <h2 class="font-bold">{{count($orgs)}}</h2>
                        </div>
                    </div>
                </div>
            </div>
           
           <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Number of Farmer's in an Organization</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="lineChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
</div>

@stop
@section('js_filtered')
@include('bis.jslinks.js_crud')
<script src="/assets/plugins/chartjs/Chart.min.js"></script>

<script type="text/javascript">
    
    $(function () {


    var dataoBj =  <?php echo json_encode($finalOrgMembers) ?>;
    var orgs = [];
    var orgsCount = [];

    for(i in dataoBj){



        orgs.push(i);
        var length = dataoBj[i].length;
        orgsCount.push(length);
        length = 0;
    }

    console.log(orgsCount);

    var lineData = {
        labels:orgs,
        datasets: [
           
            {
                label: "Example dataset",
                fillColor: "rgba(26,179,148,0.5)",
                strokeColor: "rgba(26,179,148,0.7)",
                pointColor: "rgba(26,179,148,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(26,179,148,1)",
                data:orgsCount
            }
        ]
    };

    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true,
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    //var myNewChart = new Chart(ctx).PolarArea(lineData, lineOptions);
    var myNewChart = new Chart(ctx).Bar(lineData, lineOptions);
    //var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
});
</script>
@stop