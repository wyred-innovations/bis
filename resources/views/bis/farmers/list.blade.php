@extends('bis.main.index')

<style>
    
    .slider{
        margin:0px auto;
        width: 90%;
    }
    .sliderHolder{
        padding:10px;
        background-color: #E0E0E0;
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
      background: url('/system/icons/plus.png') no-repeat center center;
      cursor: pointer;
    }
   
     tr.shown  td.details-control {
        background: url('/system/icons/minus.png') no-repeat center center;
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
@section('content')
<div class="col-lg-12" style="margin-top:-30px;">
    <h2>Farmers List Profile</h2>
    <ol class="breadcrumb beacon" >
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <a href="{{url('admin/farmers/list')}}"><strong>Farmers List</strong></a>
        </li>
    </ol>
</div>

<div class="col-lg-12 pull-bottom">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Farmers List Profile<small class="m-l-sm"></small></h5>
            <div class="ibox-tools">
               <div class="pull-right" style="margin-right:-20px;">
                <div class="col-md-12">
                 <a class="btn btn-primary" href="{{url('/bis/farmers/farmers-registration')}}" style="margin-top:-9px;"><i class="fa fa-plus"></i> Add New Farmer</a>
               </div>
               </div>
            </div>
        </div>
        <div class="ibox-content table-responsive">
            <div class="panel-group" id="accordion">
                <div class="panel">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-search"></i> Advanced Filter Search Option</a>
                        </h5>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="form-group">
                           <label>Benefactors</label>
                            <select class="form-control input-sm benefactors" id="benefactors" onchange="benefactorsChange(this)" required>
                              <option value=""></option>
                            </select>
                         </div>
                          <div class="form-group">
                           <label>Qualification Mapping Batch Code</label>
                            <select class="form-control input-sm qMapCode" id="qMapCode" onchange="qMapCodeDetail(this)" required>
                              <option value=""></option>
                            </select>
                         </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
             <div class="col-md-12">
                <table id="ref_provider" class="footable table table-stripped toggle-arrow-tiny" role="grid" aria-describedby="example2_info">
                    <thead class="header-th">
                      <tr>
                        <th><i class="fa fa-search"></i></th>
                        <th class="header-th">Name of Farmer</th>
                        <th class="header-th">Organization</th>
                        <th class="header-th">Print Preview</th>
                        <th class="header-th">Edit</th>
                        <th class="header-th">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>a</td>
                        <td>b</td>
                        <td>c</td>
                        <td><a class="btn btn-info" href="#" onclick="window.open('/reports/tvet-provider', '_blank', 'location=yes,height=500,width=750,scrollbars=yes,status=yes')"><i class="fa fa-print"></i> Print Preview</a></td>
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

<script type="text/javascript">
    $(document).ready( function(){
       $('#ref_provider').DataTable();
       ref_provider();
       $('#menu').addClass('active');
       $('#farmers-reg').addClass('active');
    });

    function ref_provider(){
      var finalDev = window.dev;
      
      $('#ref_provider').dataTable().fnClearTable();
      $("#ref_provider").dataTable().fnDestroy();

          var ref_provider_data = $('#ref_provider').DataTable({
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
                ref_provider_table = data;
                console.log(ref_provider_table);
                fnCallback(data);           
              }
            });
          },
                     
          "sAjaxSource": "/retrieve/ref_provider",
          "sAjaxDataProp": "",
          "iDisplayLength": 10,
          "scrollCollapse": false,
          "paging":         true,
          "searching": true,

          "columns": [
                {
                      "className":      'details-control',
                      "orderable":      false,
                      "data":           null,
                      "defaultContent": ''
                },
                { "mData": "provider_name", sDefaultContent: ""},
                { "mData": "providertype_name", sDefaultContent: ""},
                { "mData": "pc_name", sDefaultContent: ""},
                { sDefaultContent: "" ,
                  "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html('<a href="/admin/tvet/provider-registration?up=true&tvet='+oData.tvetpro_id+'" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>');
                  }
                },
                { sDefaultContent: "" ,
                  "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                      $(nTd).html('<a href="#" onclick="tvet_delete(this);" class="btn btn-danger btn-sm" data-table="ref_providertbl" data-id="'+oData.tvetpro_id+'" data-url="tvet_delete" class="delete_row"><i class="fa fa-trash"></i> Delete</a>');
                  }
                },
                
          ]
      });

        $('#ref_provider tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = ref_provider_data.row( tr );
            var row_id = $(tr).attr("data-id");
            
            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
                $(this).removeClass('hidden_row');
                $(this).addClass('show_row');
            }
            else {
                row.child( format(row_id)).show();
                tr.addClass('shown');
                $(this).addClass('hidden_row');
                $(this).removeClass('show_row');
            }
        });
    
    }

    function format (row_id) {
      return '<div class="sliderHolder slider">'+
                '<div class="list-group" style="margin-top:20px;background-color:#FFFFFF;">'+
                  '<a href="#" class="list-group-item active" style="text-align:left">DETAILED INFORMATION</a>'+
                  '<a href="#" class="list-group-item "><b>Date of Birth </b>: '+ref_provider_table[row_id].region_name+'</a>'+
                  '<a href="#" class="list-group-item "><b>Civil Status </b>: '+ ref_provider_table[row_id].province_name +'</a>'+
                  '<a href="#" class="list-group-item "><b>Nationality </b>: '+ ref_provider_table[row_id].district_name +'</a>'+
                  '<a href="#" class="list-group-item "><b>School Atainment </b>: '+ ref_provider_table[row_id].munipality_name +'</a>'+
                  '<a href="#" class="list-group-item "><b>Address </b>: '+ ref_provider_table[row_id].address +'</a>'+
                '</div>'+
              '</div>';  
      // return '<ul  class=" table table-bordered table-stripes">'+
      //         '<li>TVET Provider Address</li>'+
      //         '<li>Region:'+ ' ' +ref_provider_table[row_id].region_name+'</li>'+
      //         '<li>Province:'+ ' ' +ref_provider_table[row_id].province_name+'</li>'+
      //         '<li>District:'+ ' ' +ref_provider_table[row_id].district_name+'</li>'+
      //         '<li>Municipality:'+ ' ' +ref_provider_table[row_id].munipality_name+'</li>'+
      //         '<li>Address:'+ ' ' +ref_provider_table[row_id].address+'</li>'+
      //       '</ul>';
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