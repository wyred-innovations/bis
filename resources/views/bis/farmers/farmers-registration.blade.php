

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
      background: url('/system/icons/plus.png') no-repeat center center;
      cursor: pointer;
    }
   
     tr.shown  td.details-control {
        background: url('/system/icons/minus.png') no-repeat center center;
    }
    .people_table_details{
     /* background-color: #CDCDCD;
      width: 90%;
      border:1px solid black;*/
      border-radius: 5px;
      padding: 5px;

    }
    .people_table_details td{
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
<div class="col-md-1"></div>
<div class="col-lg-10">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Farmers <small class="m-l-sm">Registration</small></h5>
            <div class="ibox-tools">
               <div class="pull-right">
                <a class="btn btn-danger" href="{{url('')}}" style="margin-top:-9px;color:#FFFFFF;"><i class="fa fa-print"></i> Print</a>
                 <a class="btn btn-primary" href="{{url('bis/farmers/list')}}" style="margin-top:-9px;"><i class="fa fa-reply"></i> Back</a>
               </div>
            </div>
        </div>

      <form id="farmerForm" method="post">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="person_id" value="" />
        <div class="ibox-content">
         <div class="row">
            <div class="col-md-12">
            <h3>
            <span class="form-step"> A </span>
            <i>Socio-Demographic Profile:</i>
            </h3> 
            </div>
          <div class="col-md-6">
            <div class="form-group">
             <label>First Name</label>
              <input class="form-control input-sm" type="text" id="first_name" name="first_name" required>        
            </div>
            <div class="form-group">
             <label>Middle Name</label>
              <input class="form-control input-sm" type="text" id="middle_name" name="middle_name" required>        
            </div>
            <div class="form-group">
             <label>Last Name</label>
              <input class="form-control input-sm" type="text" id="last_name" name="last_name" required>        
            </div>
            <div class="form-group">
             <label>Name Extension (Optional)</label>
              <input class="form-control input-sm" type="text" id="name_ext" name="name_ext" >        
            </div>
            <div class="form-group">
             <label>Age</label>
              <input class="form-control input-sm" type="text" id="age" name="age" required>        
            </div>
            <div class="form-group">
             <label>Gender</label>
              <select class="form-control input-sm" name="gender" id="gender">
                <option></option>
                <option>Male</option>
                <option>Female</option>
              </select>      
            </div>
            <div class="form-group">
             <label>Religion</label>
              <input class="form-control input-sm" type="text" id="religion_name" name="religion_name" required>        
            </div>
            <div class="form-group">
             <label>Tribe</label>
              <input class="form-control input-sm" type="text" id="tribe_name" name="tribe_name" >        
            </div>
            <div class="form-group">
             <label>Organization</label>
              <input class="form-control input-sm" type="text" id="organization" name="organization" >        
            </div>
           </div>
           <div class="col-md-6">
            <div class="form-group">
             <label>Civil Status</label>
              <input class="form-control input-sm" type="text" id="civil_status" name="civil_status"  data-display="Civil Status" required>               
            </div>
            <div class="form-group">
             <label>School Attaintment</label>
                <input class="form-control input-sm" type="text" id="sch_attainment" name="sch_attainment"  data-display="School Attainment" required>               
            </div>
            <div class="form-group">
             <label>Designation</label>
              <input class="form-control input-sm" type="text" id="designation" name="designation" >        
            </div>
            <div class="form-group">
             <label>Other Income</label>
              <input class="form-control input-sm" type="text" id="other_income" name="other_income" >        
            </div>
             <div class="form-group">
            <label>Start of Cropping</label>
            <div class="input-group">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control input-sm" id="start_crop" name="start_crop" onkeypress="return isNumber(event)" required>
            </div><!-- /.input group -->
            </div>
            <div class="form-group">
             <label>Name of Spouse</label>
             <input class="form-control input-sm" type="text" id="spouse_name" name="spouse_name" >        
            </div>
            <div class="form-group">
             <label>Total Numbers of HH Members</label>
               <h5 class="pull-left form-control" id="numberRelatives"><span>1</span></h5>      
            </div>
            <div class="form-group">
             <label>Home Address</label>
              <textarea class="form-control input-sm" rows="4" id="home_address" name="home_address" required></textarea>       
            </div>
           </div>




           <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" href="" onclick="addNewRelatives();"><i class="fa fa-plus"></i> Add</button>
           </div>
           </div>

           <div class="relatives">
               <div class="col-md-12">
               <button type="button" class="btn btn-danger pull-right removeBtn btn-sm"  style="display:none;" onclick="removeDiv(this)"><i class="fa fa-close"></i></button>
              </div>

             <div class="col-md-4">
               <div class="form-group">
               <label>Age</label>
                <input class="form-control input-sm" type="text" id="h_age" name="h_age[]" required>        
              </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
               <label>Gender</label>
                <select class="form-control input-sm" name="h_gender[]" id="h_gender">
                  <option></option>
                  <option>Male</option>
                  <option>Female</option>
                </select>      
              </div>
              </div>
              <div class="col-md-4">
               <div class="form-group">
               <label>Relationship</label>
                <input class="form-control input-sm" type="text" id="h_relationship" name="relationship_name[]" required>               
              </div>
             </div>
         </div>

      <!--    <div class="col-md-12" style="margin-top:20px;">
        <h3>
        <span class="form-step"> <i class="fa fa-building" style="margin-top:3px;"></i> </span>
        House Status
        </h3> 
        </div> -->

        <!--  

        <div class="col-md-12">
            <table id="" class="table table-striped table-hover" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">House Status</th>
                    <th class="header-th">House Type</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <tr>
                    <td>
                    <div class="form-group">
                          <input class="form-control input-sm autoSuggest" data-url="/bis/getHouseStatus" data-display="house_status" type="text" id="housestatus" name="housestatus[]"  placeholder="Other (Specify)" data-display="competency_name" >        
                        </div>
                    </td>
                   
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm autoSuggest" data-url="/bis/getHouseType" data-display="house_type" type="text" id="housetype" name="housetype[]"  placeholder="Other (Specify)" data-display="competency_name" >        
                        </div>
                    </td>
                   
                  </tr>


                  
                </tbody>
              </table>
             
         </div> -->


        <div class="col-md-12">

        <div class="form-group">
          <span class="pull-right"><button class="btn btn-primary ladda ladda-button" data-url="/bis/farmer-registration" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label" id="saveBtn">Save</span></button> </span>
        </div>
        <div class="hr-line-dashed"></div>
        </div>

        </div>
        </div>

        </div>
        </div>

        </form>

<div class="col-md-1"></div>

@stop

@section('js_filtered')
@include('bis.jslinks.js_crud')

<script>
  

  $(document).ready( function(){
     $('#rockets').hide();
    // $('#income_expenses').DataTable();
     $("#start_crop").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     $('#menu').addClass('active');
    
    });


    function removeDiv(btn){

        event.preventDefault();
        var id = $(btn).closest(".relatives");        
        $(id).remove();
      
        counter();
        
    }

    function addNewRelatives(){

        event.preventDefault();
        var EmergencyClass = $(".relatives").first().clone().insertAfter("div.relatives:last");
     
        counter();
    }

    function counter(){

      var numItems = $('.relatives').length;
      $("#numberRelatives").text(numItems);

      $('#numberRelatives  span').text(parseInt($("#numberRelatives").text()) + 1);
      if(numItems == 1){
        $('.removeBtn').hide();
        return false;
      }else{
        $('.removeBtn').show();
        return false;
      }
    }

</script>
@stop