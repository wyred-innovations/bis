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

    #expenses-table td {
      height: 30px!important;
    }

    .desc { display: none; }

</style>
@stop

@section('content')


<form id="TrackingForm" >
<div class="col-md-1"></div>
<div class="col-lg-10">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Farmers <small class="m-l-sm">Records</small></h5>
            <div class="ibox-tools">
               <div class="pull-right">
                 <a class="btn btn-danger" href="{{url('')}}" style="margin-top:-9px;color:#FFFFFF;"><i class="fa fa-print"></i> Print</a>
                 <a class="btn btn-primary" href="{{url('bis/farmers/list')}}" style="margin-top:-9px;"><i class="fa fa-reply"></i> Back</a>
               </div>
            </div>
        </div>

      

        <div class="ibox-content">
        <div class="row">
        <input type="hidden" name="tracking_id" value="{{{ $track->tracking_id }}}" />
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="person_id" value="{{$user->person_id}}" />
        <div class="col-md-6">

         <div class="form-group">
          <label>Farmer Name</label>
          <h4 class="form-control">{{$user->last_name}}, {{$user->first_name}} {{$user->middle_name}}</h4>
         </div>
        </div>

        <div class="col-md-12">
         <div class="hr-line-dashed"></div>
        </div>

        <div class="col-md-12">
        <h3>
        <span class="form-step"> <i class="fa fa-filter" style="margin-top:3px;"></i> </span>
          Year 
        </h3> 
        </div>


          <div class="col-md-4">
            <div class="form-group" id="data_2">
                <label class="font-noraml">Select Year</label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control rangePicker" name="year" value="{{$year}}" value="" required>
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
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" onclick="addNewIncomeType()"><i class="fa fa-plus"></i> Add New Income Type</button>
            </div>
        </div>

         <div class="col-md-12">
            <table id="incomeTable" class="table table-striped table-hover table-bordered" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Item</th>
                    <th class="header-th text-center">Monthly Income and Expenses</th>
                    <th class="header-th text-center">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     <td><b>Kita (Income)</b></td>
                   </tr>

                  @foreach($income as $income)
                    <tr>

                     <td data-link="/bis/income-item/update/income_item" data-id="{{ $income->income_item_id }}" class="wyred-editable"><input type="hidden" value="{{ $income->income_item }}" name="income_item[]">{{ $income->income_item }}</td>
                     <td>
                      <div class="form-group">
                       <select class="form-control input-sm" name="incomerates[]" id="incomerates" >
                        <option></option>
                         @foreach($incomerates as $keyVal)
                        <option  value="{{ $keyVal->income_expenses_id }}" @if($income->income_expenses_id == $keyVal->income_expenses_id) selected @endif>{{ $keyVal->income_expenses }}</option>
                        @endforeach
                      </select>      
                     </div>
                    </td>
                  
                   </tr>
                  @endforeach
                 
                   <tr class="newIncomeType">
                    
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="income_item"  name="income_item[]"  placeholder="Other (Specify)" data-display="competency_name" >        
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                         <select class="form-control input-sm" name="incomerates[]" id="incomerates">
                          <option></option>
                           @foreach($incomerates as $keyVal)
                          <option value="{{ $keyVal->income_expenses_id }}">{{ $keyVal->income_expenses }}</option>
                          @endforeach
                        </select>      
                        </div>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeNewIncomeType(this)"><i class="fa fa-close"></i> Remove</button>
                    </td>
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
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" onclick="addNewExpensesType()"><i class="fa fa-plus"></i> Add New Expences Type</button>
            </div>
        </div>

         <div class="col-md-12">
            <table id="expenses-table" class="table table-striped table-hover table-bordered" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Item</th>
                    <th class="header-th text-center">Monthly Income and Expenses</th>
                    <th class="header-th text-center">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     <td><b>Gasto (Expenses)</b></td>
                  </tr>

                    @foreach($expenses as $expenses)
                    <tr>

                     <td data-link="/bis/expenses-item/update/expenses_item" data-id="{{ $expenses->expenses_item_id }}" class="wyred-editable"><input type="hidden" value="{{ $expenses->expenses_item }}" name="expenses_item[]">{{ $expenses->expenses_item }}</td>
                     <td>
                      <div class="form-group">
                       <select class="form-control input-sm" name="expenses_rates[]" id="expenses_rates">
                        <option></option>
                         @foreach($incomerates as $keyVal)
                        <option value="{{ $keyVal->income_expenses_id }}" @if($expenses->income_expenses_id == $keyVal->income_expenses_id) selected @endif>{{ $keyVal->income_expenses }}</option>
                        @endforeach
                      </select>      
                     </div>
                    </td>
                  
                   </tr>
                  @endforeach
               
                   <tr class="expenseType">
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="name_ext" name="expenses_item[]"  placeholder="Other (Specify)" data-display="competency_name" >        
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                         <select class="form-control input-sm" name="expenses_rates[]" id="expenses_rates">
                          <option></option>
                           @foreach($incomerates as $keyVal)
                          <option value="{{ $keyVal->income_expenses_id }}">{{ $keyVal->income_expenses }}</option>
                          @endforeach
                        </select>      
                        </div>
                    </td>
                      <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeExpenseType(this)"><i class="fa fa-close"></i> Remove</button>
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
            Credits
            </h3> 
        </div>
        <div class="col-md-12 ">
            <table id="" class="table table-striped table-hover table-bordered dataTables-example" role="grid" aria-describedby="example2_info">
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

                  @foreach($interest as $keyVal)
                  <tr>
                    <td><input type="hidden" name="srcCredit[]" value="{{ $keyVal->interest_id }}">{{ $keyVal->interest }}</td>
                    <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="parents{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->parents == 1) checked @endif type="checkbox" name="parents{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="relative{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->relative == 1) checked @endif type="checkbox"  name="relative{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="traders{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->traders == 1) checked @endif type="checkbox"  name="traders{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="diocese{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->diocese == 1) checked @endif type="checkbox"  name="diocese{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="silingan{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->silingan == 1) checked @endif type="checkbox"  name="silingan{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="govt{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->govt == 1) checked @endif type="checkbox"  name="govt{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="po{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->po == 1) checked @endif type="checkbox"  name="po{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                     <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="fo{{ $keyVal->interest_id }}" >
                          <input class="input-sm" @if($keyVal->po == 1) checked @endif type="checkbox" name="fo{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                          <input type="hidden" name="micro_finance{{ $keyVal->interest_id }}" >
                          <input class="input-sm" type="checkbox"  @if($keyVal->micro_finance == 1) checked @endif name="micro_finance{{ $keyVal->interest_id }}"  data-display="competency_name" >        
                        </div>
                    </td>
                    </tr>

                  

                  @endforeach
                 
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
              <button class="btn btn-primary btn-sm" onclick="addNewTenure()"><i class="fa fa-plus"></i> Add</button>
           </div>
           </div>

          <div class="col-md-12">
            <table id="" class="table table-striped table-hover table-bordered dataTables-example" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Land Name <small>(By Crops Planted)</small></th>
                    <th class="header-th text-center">Land Size</th>
                    <th class="header-th text-center">Land Status</th>
                    <th class="header-th text-center">Topography Size</th>
                    <th class="header-th text-center">Ownership</th>
                    <th class="header-th text-center">Remove</th>
                  </tr>
                </thead>
                <tbody>


                @foreach($ltap as $ltap)
                  <tr class="landTenure">
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="land_name" name="land_name[]"  value="{{$ltap->ltap_name}}" required>        
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="land_size" name="land_size[]" value="{{$ltap->ltap_size}}" required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="landstatus[]" id="landstatus" required>
                        <option></option>
                         @foreach($landstatus as $keyVal)
                            <option @if($keyVal->land_status_id == $ltap->land_status_id) selected @endif value="{{ $keyVal->land_status_id }}">{{ $keyVal->landstatus }}</option>
                         @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="topog_size[]" id="topog_size" > 
                        <option></option>
                         @foreach($topography as $keyVal)
                            <option @if($keyVal->topography_id == $ltap->topography_id) selected @endif value="{{ $keyVal->topography_id }}">{{ $keyVal->topography }}</option>
                         @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="ownership" name="ownership[]"   value="{{$ltap->ownership}}" required>        
                        </div>
                    </td>
                     <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeLand(this)"><i class="fa fa-close"></i> Remove</button>
                      </td>
                  </tr>
                  @endforeach

                  @if($ltap == "")
                    <tr class="landTenure">
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="land_name" name="land_name[]"  required>        
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="land_size" name="land_size[]"  required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="landstatus[]" id="landstatus" required>
                        <option></option>
                         @foreach($landstatus as $keyVal)
                            <option  value="{{ $keyVal->land_status_id }}">{{ $keyVal->landstatus }}</option>
                         @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="topog_size[]" id="topog_size" > 
                        <option></option>
                         @foreach($topography as $keyVal)
                            <option  value="{{ $keyVal->topography_id }}">{{ $keyVal->topography }}</option>
                         @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="ownership" name="ownership[]"    required>        
                        </div>
                    </td>
                     <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeLand(this)"><i class="fa fa-close"></i> Remove</button>
                      </td>
                  </tr>
                  @endif
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
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" onclick="addNewAgri()"><i class="fa fa-plus"></i> Add</button>
         </div>
         </div>

          <div class="col-md-12">
            <table id="" class="table table-striped table-hover table-bordered dataTables-example" role="grid" aria-describedby="example2_info">
                <thead class="header-th">
                  <tr>
                    <th class="header-th">Mga Tanom ug kahayupan</th>
                    <th class="header-th text-center">Type</th>
                    <th class="header-th text-center">Status</th>
                    <th class="header-th text-center">Applied Technology</th>
                    <th class="header-th text-center">Inputs Used</th>
                    <th class="header-th text-center">Remove</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($tk as $tk)
                  <tr class="agriTr">
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="tk_name" name="tk_name[]"  value="{{$tk->tk_name}}" required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="agri_type[]" id="agri_type" required>
                        <option></option>
                        @foreach($agri_type as $agri_typeData)
                        <option @if($agri_typeData->type_id == $tk->type_id) selected @endif value="{{$agri_typeData->type_id}}">{{$agri_typeData->type_name}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="agri_status[]" id="agri_status" required>
                        <option></option>
                        @foreach($agri_status as $agri_statusData)
                        <option @if($agri_statusData->status_id == $tk->status_id) selected @endif value="{{$agri_statusData->status_id}}">{{$agri_statusData->status}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
  
                        <div class="form-group">
                      <select class="form-control input-sm" name="techApply[]" id="techApply" required>
                        <option></option>
                        @foreach($techApply as $techApplyData)
                        <option @if($techApplyData->technology_apply_id == $tk->technology_apply_id) selected @endif value="{{$techApplyData->technology_apply_id}}">{{$techApplyData->technology_apply}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                    <td>
                         <div class="form-group">
                          <input class="form-control input-sm" type="text" id="input_used" name="input_used[]"  value="{{$tk->input_used}}" required>        
                        </div>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeAgriType(this)"><i class="fa fa-close"></i> Remove</button>
                      </td>
                  </tr>
                  @endforeach

                  @if($tk == "")
                    <tr class="agriTr">
                    <td>
                        <div class="form-group">
                          <input class="form-control input-sm" type="text" id="tk_name" name="tk_name[]"   required>        
                        </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="agri_type[]" id="agri_type" required>
                        <option></option>
                        @foreach($agri_type as $agri_typeData)
                        <option  value="{{$agri_typeData->type_id}}">{{$agri_typeData->type_name}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                      <select class="form-control input-sm" name="agri_status[]" id="agri_status" required>
                        <option></option>
                        @foreach($agri_status as $agri_statusData)
                        <option  value="{{$agri_statusData->status_id}}">{{$agri_statusData->status}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                     <td>
  
                        <div class="form-group">
                      <select class="form-control input-sm" name="techApply[]" id="techApply" required>
                        <option></option>
                        @foreach($techApply as $techApplyData)
                        <option  value="{{$techApplyData->technology_apply_id}}">{{$techApplyData->technology_apply}}</option>
                        @endforeach
                      </select>      
                    </div>
                    </td>
                    <td>
                         <div class="form-group">
                          <input class="form-control input-sm" type="text" id="input_used" name="input_used[]"   required>        
                        </div>
                    </td>
                    <td class="text-center">
                      <button class="btn btn-danger btn-sm" onclick="removeAgriType(this)"><i class="fa fa-close"></i> Remove</button>
                      </td>
                  </tr>
                  @endif
                </tbody>
              </table>

              
         </div>

         </div>
        </div>
   

      <!-- END OF FORM -->

    </div>
</div>
      <div class="col-md-12">

        <div class="form-group">

          <span class="pull-right"><button class="btn btn-primary ladda ladda-button" data-url="/bis/update-new-tracking" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label" id="saveBtn">Save</span></button> </span>
        </div>
        <div class="hr-line-dashed"></div>
        </div>


 </form>
<div class="col-md-1"></div>

@stop

@section('js_filtered')
@include('bis.jslinks.js_crud')

<script src ="/assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src ="/assets/js/custom/wyrededitable.js" type="text/javascript"></script>

<script>
  

  $(document).ready( function(){
    $('#rockets').hide();
     $("#start_crop").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
     


      $(".rangePicker").datepicker({
          format: "yyyy", // Notice the Extra space at the beginning
          viewMode: "years",
          minViewMode: "years"
      });
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

    function addNewIncomeType(){
        event.preventDefault();
        var addObj = $(".newIncomeType").last().clone().insertAfter(".newIncomeType:last");

    }

    function addNewExpensesType(){
        event.preventDefault();
        var addObj = $(".expenseType").last().clone().insertAfter(".expenseType:last");

    }

    function addNewTenure(){
        event.preventDefault();
        var addObj = $(".landTenure").last().clone().insertAfter(".landTenure:last");

    }

    function addNewAgri(){
        event.preventDefault();
        var addObj = $(".agriTr").last().clone().insertAfter(".agriTr:last");

    }

    function removeNewIncomeType(btnThis){

        event.preventDefault();
        var parent = $('.newIncomeType').parent().parent();
        var parentLength= $('.newIncomeType').length;


        if(parentLength == 1){
          return false;
        }

        var remove = $(btnThis).parent().parent().remove();

    }

    function removeExpenseType(btnThis){

        event.preventDefault();
        var parent = $('.expenseType').parent().parent();
        var parentLength= $('.expenseType').length;


        if(parentLength == 1){
          return false;
        }

        var remove = $(btnThis).parent().parent().remove();

    }

    function removeLand(btnThis){

        event.preventDefault();
        var parent = $('.landTenure').parent().parent();
        var parentLength= $('.landTenure').length;


        if(parentLength == 1){
          return false;
        }

        var remove = $(btnThis).parent().parent().remove();

    }

    function removeAgriType(btnThis){

        event.preventDefault();
        var parent = $('.agriTr').parent().parent();
        var parentLength= $('.agriTr').length;

        if(parentLength == 1){
          return false;
        }

        var remove = $(btnThis).parent().parent().remove();

    }


</script>
@stop