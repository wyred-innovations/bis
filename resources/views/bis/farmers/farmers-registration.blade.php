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
@section('content')
<div class="col-md-1"></div>
<div class="col-lg-10">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Farmers <small class="m-l-sm">Registration</small></h5>
            <div class="ibox-tools">
               <div class="pull-right">
                 <a class="btn btn-primary" href="{{url('bis/farmers/list')}}" style="margin-top:-9px;"><i class="fa fa-reply"></i> Back</a>
               </div>
            </div>
        </div>

      

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
              <input class="form-control input-sm" type="text" id="first_name" name="first_name"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Middle Name</label>
              <input class="form-control input-sm" type="text" id="middle_name" name="middle_name"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Last Name</label>
              <input class="form-control input-sm" type="text" id="last_name" name="last_name"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Name Extension (Optional)</label>
              <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Age</label>
              <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>        
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
              <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Tribe</label>
              <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Total Numbers of HH Members</label>
               <h5 class="pull-left form-control" id="numberRelatives"><span>1</span></h5>      
            </div>
           </div>
           <div class="col-md-6">
            <div class="form-group">
             <label>Civil Status</label>
               <select class="form-control input-sm" name="gender" id="gender">
                <option></option>              
               </select>
            </div>
            <div class="form-group">
             <label>School Attaintment</label>
              <select class="form-control input-sm" name="gender" id="gender">
                <option></option>              
               </select>
            </div>
            <div class="form-group">
             <label>Designation</label>
              <input class="form-control input-sm" type="text" id="last_name" name="last_name"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Other Income</label>
              <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
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
             <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>        
            </div>
            <div class="form-group">
             <label>Home Address</label>
              <textarea class="form-control input-sm" rows="4" id="age" name="age"  data-display="competency_name" required></textarea>       
            </div>
           </div>


           <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" href="" onclick="addNewRelatives();"><i class="fa fa-plus"></i> Add</button>
           </div>
           </div>

           <div class="relatives">
             <div class="col-md-12">
              
             <button type="button" class="btn btn-danger pull-right removeBtn btn-sm"  onclick="removeDiv(this)"><i class="fa fa-close"></i></button>
            </div>

           <div class="col-md-4">
             <div class="form-group">
             <label>Age</label>
              <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>        
            </div>
            </div>
            <div class="col-md-4">
             <div class="form-group">
             <label>Gender</label>
              <select class="form-control input-sm" name="gender" id="gender">
                <option></option>
                <option>Male</option>
                <option>Female</option>
              </select>      
            </div>
            </div>
            <div class="col-md-4">
             <div class="form-group">
             <label>Relationship</label>
              <input class="form-control input-sm" type="text" id="age" name="age"  data-display="competency_name" required>               
            </div>
           </div>
         </div>

        <div class="col-md-12">
        <div class="hr-line-dashed"></div>
        </div>

        <div class="col-md-12">
        <h3>
        <span class="form-step"> <i class="fa fa-money"  style="margin-top:3px;"></i> </span>
        Estimated Monthly Income and Expenses
        </h3> 
        </div>

         <div class="col-md-12">
            <table id="" class="footable table table-stripped toggle-arrow-tiny" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Item</th>
                    <th class="header-th text-center">Monthly Income and Expenses</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <tr>
                     <td><b>Kita (Income)</b></td>
                     <td colspan="4"><button class="btn btn-primary btn-sm pull-right" href=""><i class="fa fa-plus"></i> Add</button></td>
                    </tr>
                    <td>Monthly Income</td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                  </tr>
                   <tr>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  placeholder="Other (Specify)" data-display="competency_name" required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                  </tr>
                </tbody>
              </table>
         </div>

        <div class="col-md-12">
        <div class="hr-line-dashed"></div>
        </div>

        <div class="col-md-12" style="margin-top:20px;">
        <h3>
        <span class="form-step"> <i class="fa fa-building" style="margin-top:3px;"></i> </span>
        House Status
        </h3> 
        </div>

         <div class="col-md-12" >
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" href=""><i class="fa fa-plus"></i> Add</button>
           </div>
           </div>

        <div class="col-md-12">
            <table id="" class="Datatable table table-stripped " role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th"></th>
                    <th class="header-th">1</th>
                    <th class="header-th">2</th>
                    <th class="header-th">3</th>
                    <th class="header-th">4</th>
                    <th class="header-th">5</th>
                    <th class="header-th text-center">Others (Pls. Specify)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Owned</td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td>
                    <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                  </tr>

                  <tr  id="addHouseStatus">
                     <td>
                    <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext" placeholder="Other (Specify)" required>        
                        </div>
                    </td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td><input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios"></td>
                    <td>
                    <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <legend>Legend</legend>
              <div class="col-md-4">
              <h5>1 - Make Shift</h5> 
              <h5>2 - Nipa and Bamboo/lumber</h5>
             </div>
             <div class="col-md-4">
              <h5>3 - Corruated sheet and Bamboo/lumber</h5> 
              <h5>4 - Semi-concrete</h5>
             </div>
             <div class="col-md-4">
              <h5>5 - Concrete</h5> 
             </div>
         </div>

        <div class="col-md-12" style="margin-top:20px;">
         <legend class="well text-center" style="font-size:12px!important;">
           <p>Duna bay utang sa pagkakaron?&nbsp;
            <label> 
            <input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios">
                Yes
            </label>
             <label> 
            <input type="radio"  value="option1" id="optionsRadios1" name="optionsRadios">
                No
            </label>&nbsp;
            (Kung duna,palihug pagcheck sa ubos)&nbsp;
            (PO- Peoples' Org., FO-Farmers Org)
           </p>
         </legend>
        </div>

        <div class="col-md-12">
            <table id="" class="Datatable table table-stripped " role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Sources of Credits</th>
                    <th class="header-th">Parents</th>
                    <th class="header-th">Relative</th>
                    <th class="header-th">Traders</th>
                    <th class="header-th">Diocese/Parish</th>
                    <th class="header-th">Silingan/higala</th>
                    <th class="header-th">Gov't.</th>
                    <th class="header-th">PO</th>
                    <th class="header-th">FO</th>
                    <th class="header-th">Micro Finance</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Monthly interest rate</td>
                    <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                          <input class="input-sm" type="checkbox" id="name_ext" name="name_ext"  data-display="competency_name" >        
                        </div>
                    </td>
                  
                    </tr>
                 
                </tbody>
              </table>
            
         </div>

         <div class="col-md-12">
        <div class="hr-line-dashed"></div>
        </div>

          <div class="col-md-12" style="margin-top:20px;">
            <h3>
            <span class="form-step"> B </span>
            Land Tenure and Agricultural Practices:
            </h3> 
         </div>

         <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" href=""><i class="fa fa-plus"></i> Add</button>
           </div>
           </div>

          <div class="col-md-12">
            <table id="" class="footable table table-stripped toggle-arrow-tiny" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Land Name <small>(By Crops Planted)</small></th>
                    <th class="header-th text-center">Land Size</th>
                    <th class="header-th text-center">Land Status</th>
                    <th class="header-th text-center">Topography Size</th>
                    <th class="header-th text-center">Ownership</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                     <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                     <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
         </div>

         <div class="col-md-12">
        <div class="hr-line-dashed"></div>
        </div>

          <div class="col-md-12" style="margin-top:20px;">
            <h3>
            <span class="form-step"> C </span>
            <i>Mga Tanom ug kahayupan</i>
            </h3> 
         </div>

         <div class="col-md-12">
           
           </div>

          <div class="col-md-12">
            <table id="" class="footable table table-stripped toggle-arrow-tiny" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Mga Tanom ug kahayupan</th>
                    <th class="header-th text-center">Status</th>
                    <th class="header-th text-center">Applied Technology</th>
                    <th class="header-th text-center">Inputs Used</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <tr>
                     <td><b>BIO-INTENSIVE GARDEN (Backyard)</b></td>
                     <td colspan="4"><button class="btn btn-primary btn-sm pull-right" href=""><i class="fa fa-plus"></i> Add</button></td>
                    </tr>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="gender" id="gender">
                        <option></option>
                        <option>Below 1000</option>
                        <option>1000-1500</option>
                      </select>      
                    </div>
                    </td>
                     <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="name_ext"  data-display="competency_name" required>        
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>

               <legend>Legend</legend>
              <div class="col-md-4">
              <h5>1 - Make Shift</h5> 
              <h5>2 - Nipa and Bamboo/lumber</h5>
             </div>
             <div class="col-md-4">
              <h5>3 - Corruated sheet and Bamboo/lumber</h5> 
              <h5>4 - Semi-concrete</h5>
             </div>
             <div class="col-md-4">
              <h5>5 - Concrete</h5> 
             </div>
         </div>

         </div>
        </div>
        <div class="ibox-footer" style="min-height:55px;">
            <span class="pull-right">
            <button class="btn btn-primary ladda ladda-button" data-url="/save/competency-type" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label">Save</span></button> </span>
            </span>
        </div>

      <!-- END OF FORM -->

    </div>
</div>
<div class="col-md-1"></div>

<script>
  

  $(document).ready( function(){
     $('#income_expenses').DataTable();
     $("#start_crop").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     $('#menu').addClass('active');
     $('#farmers-reg').addClass('active');
    });


    function removeDiv(btn){
        var id = $(btn).closest("div");
        var numItems = $('.relatives').length;
        
        $('#numberRelatives  span').text(parseInt($("#numberRelatives").text()) - 1);

        if(numItems == 1){
          $(id).find('input:text').val('');
          $(id).find('select').val('');
          $('.removeBtn').hide();
          return false;
        }
        else if(numItems == 2){
          $(id).find('input:text').val('');
          $(id).find('select').val('');
          $('.removeBtn').hide();
        }
        

        $(id).remove();
           
        
    }

    function addNewRelatives(){

        var EmergencyClass = $(".relatives").first().clone().insertAfter("div.relatives:last");

        var numItems = $('.relatives').length;

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