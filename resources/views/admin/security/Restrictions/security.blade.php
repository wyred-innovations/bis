
@extends('admin.index')
<style>
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  .bootstrap-switch { height: 2.3em }

</style>
@section('content')

<div class="col-lg-12" style="margin-top:-30px;">
    <h2>Security</h2>
    <ol class="breadcrumb beacon" >
        <li>
            <a href="/">Home</a>
        </li>
        <li class="active">
            <a href="{{url('admin/security/Restrictions/reference/content')}}"><strong>Security</strong></a>
        </li>
       
    </ol>
</div>
<div class="col-lg-12">

</div>
 <div class="col-lg-12 pull-bottom">
      <div class="tabs-container">
          <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#account">Basic Competencies</a></li>
          </ul>
          <div class="tab-content">
              <div id="account" class="tab-pane active">
                 <form id="accountForm">
               <div class="panel-body">
                 <div class="ibox float">
                          <div class="ibox-title">
                              <h5>Learning Outcome<small class="m-l-sm">List</small></h5>
                              <div class="ibox-tools">
                                 <div class="pull-right">
                                  <div class="col-md-12">
                                  <a class="btn btn-info" href="{{url('admin/security/Restrictions/reference/content')}}" style="margin-top:-9px;color:#FFFFFF;"><i class="fa fa-print"></i> Reference</a>
                                 </div>
                                 </div>
                              </div>
                          </div>
                      <div class="ibox-content table-responsive">
                    <h2>Account Information</h2>
                    <div class="row">
                        <div class="col-lg-8">
                           <div class="form-group">
                                <label>Permission Role</label>
                                <select id="roleId" name="roleId" class="form-control ">
                                    <option></option>
                                    @foreach($roles as $rolesKey)
                                    <option value="{{ $rolesKey->role_id }}">{{ $rolesKey->role_name }}</option>
                                    @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label>System User</label>
                                <select id="system_user" name="system_user" class="form-control ">
                                    <option></option>
                                    <option value="administrator">Administrator</option>
                                    <option value="employee">Employee</option>
                                 </select>
                            </div>
                            <div class="form-group" id="companyDiv">
                                <label>Company Name</label>
                                <select id="company_name" name="company_name" class="form-control  company_name">
                                <option></option>
                                @foreach($company as $companyKey)
                                <option value="{{ $companyKey->company_id }}">{{ $companyKey->company_name }}</option>
                                @endforeach
                                </select>
                            </div>
                           <div class="form-group">
                                <label>First Name </label>
                                <input id="" name="firstName"  type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Middle Name </label>
                                <input  name="middleName"  type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input  name="lastName"  type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Email Address *</label>
                                <input id="emailAdd" name="emailAdd"  type="email" class="form-control required">
                            </div>

                            <div class="form-group">
                                <label>Username *</label>
                                <input id="userName" name="username"  type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" name="password"  type="password" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input id="confirm" name="confirm"  type="password" class="form-control required">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px;margin-left: 20px;">
                                    <i class="fa fa-lock" style="font-size: 180px;color: #1AB94 "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                     </div>
                  </div>
                  <div class="ibox-footer" style="min-height:55px;">
                      <span class="pull-right">
                      <button class="btn btn-primary ladda ladda-button" data-url="/save/account" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label">Save</span></button> </span>
                      </span>
                  </div>
                  </form>
              </div> 
          </div>
      </div>
  </div>



    <script>
        
        $(document).ready(function(){
           $(".check-switch").bootstrapSwitch();
        });

    </script>
@stop