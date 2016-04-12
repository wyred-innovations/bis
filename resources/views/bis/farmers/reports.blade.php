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
<link href="/assets/css/plugins/iCheck/custom.css" rel="stylesheet">
@stop

@section('content')

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
                              <form id="trackYears">
                                <div class="col-md-12">
                                <div class="col-md-4">
                                  <div class="form-group">
                                   <label>Select Option</label>
                                    <select class="form-control input-sm" name="type" id="type" required>
                                      <option></option>
                                      <option value="Farmers">Farmers</option>
                                      <option value="Organization">Organization</option>
                                    </select>      
                                  </div>
                                  </div>
                                  <div class="col-md-4" id="person" style="display: none">
                                  <div class="form-group">
                                   <label>Results</label>
                                    <select class="form-control input-sm" name="sub_category" id="sub_category" required>
                                      <option></option>
                                      <option value="All">All</option>
                                      @foreach($person as $person)
                                      <option value="{{ $person->person_id }}">{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</option>
                                      @endforeach
                                    </select>      
                                  </div>
                                  </div>
                                  <div class="col-md-4" id="organization" style="display: none">
                                  <div class="form-group">
                                   <label>Results</label>
                                    <select class="form-control input-sm" name="organization_id" id="organization_id" required>
                                      <option></option>
                                      <option>All</option>
                                    </select>      
                                  </div>
                                  </div>
                                   <div class="col-md-4">
                                    <div class="form-group" id="data_5">
                                      <label>Range select</label>
                                      <div class="input-daterange input-group" id="datepicker">
                                          <input type="text" class="input-sm form-control rangePicker" name="start" required>
                                          <span class="input-group-addon">to</span>
                                          <input type="text" class="input-sm form-control rangePicker" name="end" required>
                                      </div>
                                  </div>
                                    </div>

                                    <div class="form-group">
                                   <label>Additional Filter</label>

                                        <div class="i-checks"><label> <input type="checkbox" name="show_income" value="true"> <i></i> Show Income </label></div>
                                        <div class="i-checks"><label> <input type="checkbox" name="show_expenses" value="true"> <i></i> Show Expenses </label></div>
                          
                                    </div>
                                    <div class="col-md-12">

                                    <div class="form-group">
                                      <span class="pull-left" onclick="openPrint()"><button class="btn btn-primary " ><span>Generate Report</span></button> </span>
                                    </div>

                                 <!--    <div class="form-group">
                                      <span class="pull-left" onclick="generateBar()"><button class="btn btn-primary " ><span>Generate Bargraph</span></button> </span>
                                    </div> -->


                                  </div>

                                    </form>
                             

                                  


                                  
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
                              </div>


                        <div class="col-md-12">
                              <div class="hr-line-dashed"></div>
                          </div>

                          <div class="col-md-12">
                          <h3>
                          <span class="form-step"> <i class="fa fa-money"  style="margin-top:3px;"></i> </span>
                          Estimated Monthly Income
                          </h3> 
                          </div>

                           <div class="col-md-12">
                              <table id="incomeTable" class="table table-striped table-hover" role="grid" aria-describedby="example2_info">
                                  <thead class="header-th">
                                    <tr>
                                      <th class="header-th">Item</th>
                                      <th class="header-th text-center">Monthly Income</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                       <td colspan="2"><b>Kita (Income)</b></td>
                                    </tr>
                                    <tr>
                                      <td class="text-center">A</td>
                                      <td class="text-center">B</td>
                                    </tr>
                              

                                  </tbody>
                                </table>
                           </div>


                               <div class="col-md-12">
                              <div class="hr-line-dashed"></div>
                          </div>

                          <div class="col-md-12">
                          <h3>
                          <span class="form-step"> <i class="fa fa-money"  style="margin-top:3px;"></i> </span>
                          Estimated Monthly Expenses
                          </h3> 
                          </div>

                           <div class="col-md-12">
                              <table id="incomeTable" class="table table-striped table-hover" role="grid" aria-describedby="example2_info">
                                  <thead class="header-th">
                                    <tr>
                                      <th class="header-th">Item</th>
                                      <th class="header-th text-center">Estimated Monthly Expenses</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                       <td colspan="2"><b>Gasto (Expenses)</b></td>
                                    </tr>
                                    <tr>
                                      <td class="text-center">A</td>
                                      <td class="text-center">B</td>
                                    </tr>
                              

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
<script src="/assets/js/plugins/iCheck/icheck.min.js"></script>
<script>


  $(document).ready(function () {
    $('#rockets').hide();
          $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
          });
      });
       


  

  $(document).ready( function(){
     $('#menu').addClass('active');
     $('#reports').addClass('active');


      $(".rangePicker").datepicker({
          format: "yyyy", // Notice the Extra space at the beginning
          viewMode: "years",
          minViewMode: "years"
      });

});

  function openPrint(){

      event.preventDefault();

      var url = '/reports/track-years';
      data = $("#trackYears").serialize();

      validateInfo(url,data);

      console.log(data);

      var left = (screen.width/2)-(950/2);
      var top = (screen.height/2)-(950/2);
      window.open('/reports/track-years?'+data, '_blank', 'left='+left+',top='+top+',location=yes,height=500,width=750,scrollbars=yes,status=yes');
  }

  function generateBar(){

      event.preventDefault();

      var url = '/reports/bargraph?';
      data = $("#trackYears").serialize();

      validateInfo(url,data);

      console.log(data);

      var left = (screen.width/2)-(950/2);
      var top = (screen.height/2)-(950/2);
      window.open(url+data, '_blank', 'left='+left+',top='+top+',location=yes,height=500,width=750,scrollbars=yes,status=yes');
  }

  $('#type').change(function(){
      
          if(this.value == "Farmers"){
              $('#person').show();
              $('#organization').hide();
          }else{
              $('#person').hide();
              $('#organization').show();
          }
  });


  function validateInfo(url,data){

        $.ajax( {

          url: url,
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          success:function(data){
           
             
                if(data[0] == true){


                }else if(data[0] == false){

                  fail('alert_message',data[1]);
                  return false;

                }

            },
              error: function (error) {
              
              }

        });
  }
  </script>
@stop