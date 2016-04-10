@extends('bis.main.index')

@section('css_filtered')
@include('bis.csslinks.css_crud')

<style>


    
    .slider{
        margin:0px auto;
        width: 90%;
    }
    .sliderHolder{
        padding:10px;
        background-color: #E0E0E0;
        height: auto;
    }

    .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {

      background-color: #484A49 !important;
      border-color: #484A49 !important;
    }


    .list-group-item {
      padding: 4px 15px !important;

    }   
    table.dataTable tbody td.no-padding {
        padding: 0;
    }
     th{
        text-align: center;
        font-size: 12px;
    }
    .header-th {
        background: #E76229!important;
        color: #FFFFFF;
    }
    div.slider {
    display: none;
    }


    td.details-control {
      background: url('/assets/system/icons/plus.png') no-repeat center center;
      cursor: pointer;
    }
   
     tr.shown  td.details-control {
        background: url('/assets/system/icons/minus.png') no-repeat center center;
    }
    .ref_provider_details{
     /* background-color: #CDCDCD;
      width: 90%;
      border:1px solid black;*/
      border-radius: 5px;
      padding: 5px;

    }
    .ref_provider_details td{
    /*  border:1px solid black;
      padding: 10px;
      margin:20px;*/
    }
    .table-detail{
        background-color: #CDCDCD;
    }


  
</style>
@stop

@section('content')
<form id="reportForm" >

<div class="col-lg-12" style="margin-top:-30px;">
    <h2>Reports</h2>
    <ol class="breadcrumb beacon" >
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <a href="{{url('bis/farmers/reports')}}"><strong>Reports</strong></a>
        </li>
    </ol>
</div>
<div class="col-lg-12 pull-bottom">
<div class="row">
  <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Reports</h5>
          </div>
          <div class="ibox-content">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                              <h5 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Filter By Year</a>
                              </h5>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">

                                <div class="col-md-12">
                                <div class="col-md-4">
                                  <div class="form-group">
                                   <label>Select Option</label>
                                    <select class="form-control input-sm" name="type" id="type">
                                      <option></option>
                                      <option value="Farmers">Farmers</option>
                                      <option value="Organization">Organization</option>
                                    </select>      
                                  </div>
                                  </div>
                                  <div class="col-md-4" id="person" style="display: none">
                                  <div class="form-group">
                                   <label>Results</label>
                                    <select class="form-control input-sm" name="person_id" id="person_id">
                                      <option></option>
                                      <option>All</option>
                                      @foreach($person as $person)
                                      <option value="{{ $person->person_id }}">{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</option>
                                      @endforeach
                                    </select>      
                                  </div>
                                  </div>
                                  <div class="col-md-4" id="organization" style="display: none">
                                  <div class="form-group">
                                   <label>Results</label>
                                    <select class="form-control input-sm" name="organization_id" id="organization_id">
                                      <option></option>
                                      <option>All</option>
                                    </select>      
                                  </div>
                                  </div>
                                   <div class="col-md-4">
                                    <div class="form-group" id="data_5">
                                      <label>Range select</label>
                                      <div class="input-daterange input-group" id="datepicker">
                                          <input type="text" class="input-sm form-control rangePicker" name="start" >
                                          <span class="input-group-addon">to</span>
                                          <input type="text" class="input-sm form-control rangePicker" name="end" >
                                      </div>
                                  </div>
                                  </div>
                                  
                                  <div class="col-md-12">

                                    <div class="form-group">
                                      <span class="pull-left"><button class="btn btn-primary ladda-report ladda-button" data-url="/bis/bargraph-report" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label" id="saveBtn">Generate Report</span></button> </span>
                                    </div>
                                  </div>
                                  </form>


                                  <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                           
                                        </div>
                                        <div class="ibox-content" id="barchartContainer">
                                                <div>
                                                    <canvas id="barCharts" ></canvas>
                                                </div> 
                                        </div>
                                    </div>
                                </div>
                                </div>

                              </div>
                          </div>
                      </div>
                      <div class="panel panel-info">
                          <div class="panel-heading">
                              <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Basic Listing </a>
                              </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse">
                              <div class="panel-body">

                              <div class="col-md-12">
                                 <div class="col-md-4">
                                  <div class="form-group">
                                   <label>Farmers</label>
                                    <select class="form-control input-sm" name="gender" id="gender">
                                      <option></option>
                                      <option value="All">All</option>
                                      
                                    </select>      
                                  </div>
                                  </div>
                                  <div class="col-md-4">
                                  <div class="form-group">
                                   <label>Organization</label>
                                    <select class="form-control input-sm" name="gender" id="gender">
                                      <option></option>
                                      <option>All</option>
                                    </select>      
                                  </div>
                                  </div>
                                   <div class="col-md-4">
                                    <div class="form-group" id="data_2">
                                        <label class="font-noraml">Select Year</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control rangePicker" value="">
                                        </div>
                                    </div>
                                  </div>

                               
                                
                                  <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Bar Chart Example <small>With custom colors.</small></h5>
                                        </div>
                                        <div class="ibox-content">
                                                
                                        </div>
                                    </div>
                                </div>
                                </div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

 <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                  </div>

<canvas id="pieChart" style="height:250px"></canvas>
<canvas id="areaChart" style="height:250px;display:none;"></canvas>

@stop
@section('js_filtered')
@include('bis.jslinks.js_crud')

<script src ="/assets/js/custom/laddaReport.js" type="text/javascript"></script>
<script src ="/assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="/assets/plugins/chartjs/Chart.min.js"></script>
<script>
  

  $(document).ready( function(){

     $('#menu').addClass('active');
     $('#reports').addClass('active');


      $(".rangePicker").datepicker({
          format: "yyyy", // Notice the Extra space at the beginning
          viewMode: "years",
          minViewMode: "years"
      });

});



  $('#type').change(function(){
      
          if(this.value == "Farmers"){
              $('#person').show();
              $('#organization').hide();
          }else{
              $('#person').hide();
              $('#organization').show();
          }
  });

  </script>
@stop