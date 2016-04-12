@extends('bis.main.index')

@section('css_filtered')
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
        background: #22C2C4!important;
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
<div class="col-lg-12" style="margin-top:-30px;">
    <h2>Farmer's Income and Expenses</h2>
    <ol class="breadcrumb beacon" >
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <a href="{{url('bis/farmers/list')}}"><strong>Income and Expenses</strong></a>
        </li>
    </ol>
</div>

<div class="col-lg-12 pull-bottom">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Farmer's Income and Expenses<small class="m-l-sm"></small></h5>
            <div class="ibox-tools">
               <div class="pull-right" style="margin-right:-20px;">
                <div class="col-md-12">
                 <a class="btn btn-primary" href="/bis/farmers/new-tracking/{{$user->person_id}}" style="margin-top:-9px;"><i class="fa fa-plus"></i> Track New Data</a>
               </div>
               </div>
            </div>
        </div>
        <div class="ibox-content table-responsive">
            <div class="row">
             <div class="col-md-12">
                <table id="yearList" class="table table-striped table-hover table-bordered">
                    <thead>
                      <tr>
                        <th class="header-th">Year</th>
                        <th class="header-th">Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        <div class="ibox-footer">
           
        </div>
    </div>
</div>
@stop


@section('js_filtered')
@include('bis.jslinks.js_datatables')
<script type="text/javascript">
    $(document).ready( function(){
      $('#rockets').hide();
       $('#ref_provider').DataTable();
       ref_provider();
       
    });

    function ref_provider(){
      
      $('#yearList').dataTable().fnClearTable();
      $("#yearList").dataTable().fnDestroy();

          var farmer_table = $('#yearList').DataTable({
          responsive: true,
          bAutoWidth:false,

          "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            nRow.setAttribute('data-id',aData.row_id);
            nRow.setAttribute('class','ref_provider_info_class');
          },

          "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
            oSettings.jqXHR = $.ajax( {
              "dataType": 'json',
              "type": "GET",
              "url": sSource,
              "data": aoData,
              "success": function (data) {
                farmer_data = data;
                console.log(farmer_data);
                fnCallback(farmer_data);           
              }
            });
          },
                     
          "sAjaxSource": "/retrieve/trackingYears/{{$user->person_id}}",
          "sAjaxDataProp": "",
          "iDisplayLength": 10,
          "scrollCollapse": false,
          "paging":         true,
          "searching": true,

          "columns": [
               
            
                { "mData": "year", sDefaultContent: ""},
            
                { sDefaultContent: "" ,
                  "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html('<a href="/retrieve/trackingYears/'+oData.person_id+'/'+oData.year+'" class="btn btn-primary col-xs-5 btn-sm"><i class="fa fa-pencil"></i> Edit</a> <div class="col-xs-1"></div> <a class="btn btn-success btn-sm col-xs-5" href="">View</a>');
                  }
                },
               
                
          ]
      });

        $('#farmerList tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = farmer_table.row( tr );
            var row_id = $(tr).attr("data-id");
            
            if ( row.child.isShown() ) {
                  
              $('div.slider', row.child()).slideUp( function () {
                  row.child.hide();
                  tr.removeClass('shown');
              } );
              }
              else {
                  // Open this row
                  var prop_id_name = $(tr).attr("data-id");
                  row.child( format(row_id)).show();
                  $('div.slider', row.child()).slideDown();
                  tr.addClass('shown');
                  //ref_serial(prop_id_name);
              }

          } );
    
    }

    function format (row_id) {

               return '<div class="sliderHolder"><div class="slider" style="">'+
                '<div class="list-group" style="margin-top:20px;background-color:#FFFFFF;">'+
                  '<a href="#" class="list-group-item active" style="text-align:left">DETAILED INFORMATION</a>'+
                  '<a href="#" class="list-group-item "><b>Full Name </b>: '+removeNull(farmer_data[row_id].last_name)+ " "+ removeNull(farmer_data[row_id].first_name)+", "+removeNull(farmer_data[row_id].middle_name)+'</a>'+
                  '<a href="#" class="list-group-item "><b>Age </b>: '+ removeNull(farmer_data[row_id].age) +'</a>'+
                  '<a href="#" class="list-group-item "><b>Gender </b>: '+ removeNull(farmer_data[row_id].gender) +'</a>'+
                  '<a href="#" class="list-group-item "><b>Religion </b>: '+ removeNull(farmer_data[row_id].religion_name) +'</a>'+
                  '<a href="#" class="list-group-item "><b>Spouse(if any) </b>: '+ removeNull(farmer_data[row_id].spouse) +'</a>'+
                  '<a href="#" class="list-group-item "><b>Organization </b>: '+ removeNull(farmer_data[row_id].organization_name) +'</a>'+
                '</div>'+
              '</div></div>';  
      // return '<ul  class=" table table-bordered table-stripes">'+
      //         '<li>TVET Provider Address</li>'+
      //         '<li>Region:'+ ' ' +ref_provider_table[row_id].region_name+'</li>'+
      //         '<li>Province:'+ ' ' +ref_provider_table[row_id].province_name+'</li>'+
      //         '<li>District:'+ ' ' +ref_provider_table[row_id].district_name+'</li>'+
      //         '<li>Municipality:'+ ' ' +ref_provider_table[row_id].munipality_name+'</li>'+
      //         '<li>Address:'+ ' ' +ref_provider_table[row_id].address+'</li>'+
      //       '</ul>';
    }


function removeNull(Val){
  if(Val == null){
    return "";
  }else{
    return Val;
  }
} 

function tvet_delete(btn){
    var url = $(btn).attr("data-url");
    var table_id = $(btn).attr("data-table");
    var data_id = $(btn).attr("data-id");
    var value = $(btn).attr('data-val');
    var title = $(btn).attr('data-title');

    var sourceName = $(btn).attr('data-sourceName');
    var sourceId = $(btn).attr('data-sourceId');

    swal({   
      title:title, 
      text: value,  
      type: "warning",   
      showCancelButton: true,   
      closeOnCancel:true, 
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      closeOnConfirm: false },

    function(inputValue){   

      if (inputValue === false) {
        return false;      
      }
      if (inputValue === ""){ 
        swal.showInputError("You need to write something!");     
        return false  ; 
      }  

      $.ajax( {

        url: "/"+url+"?id="+data_id+"&name="+inputValue+"&sourceName="+sourceName+"&sourceId="+sourceId+"&title="+value,
        type: 'POST',
        data: "",
        processData: false,
        contentType: false,
        success:function(data){

          if(data[0] == true){
            approved(data[1]);
            try {
              window[table_id]();
            }catch (e) {
              console.log("error no table to refresh proceeding to next");
            }
          }else if(data[0] == false){
            setTimeout(function() {
              }, 1000);
            fail(data[1]);
          }

        },error:function(){ 
          swal.close();
        }

      });

    });

}

</script>

@stop