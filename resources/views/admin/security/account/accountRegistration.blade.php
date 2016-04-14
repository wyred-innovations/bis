@extends('bis.main.index')


@section('css_filtered')
@include('bis.csslinks.css_crud')

@stop


@section('content')


<div style="width:700px;margin:auto"> 	
	<div class="col-md-12 ">	
		<form id="accountRegistration" >
			<div class="registration-form">  

				<p class="text-success"><?php if(isset($message)){ echo $message; } ?></p>
			    <h4>Registration Form</h4>
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

			    <div class="form-group">
			      	<label>First Name</label>
			      	<input type="text" class="form-control" data-toggle="tooltip" title="Write your First Name" placeholder="First Name" name="fname">
			    </div>

			    <div class="form-group">
			      	<label>Middle Name</label>
			      	<input type="text" class="form-control" data-toggle="tooltip" title="Write your Middle Name" placeholder="Middle Name" name="mname">
			    </div>

			    <div class="form-group">
			      	<label>Last Name</label>
			      	<input type="text" class="form-control" data-toggle="tooltip" title="Write your Last Name" placeholder="Last Name" name="lname">
			    </div>

			    <div class="form-group">
			      	<label>Email</label>
			      	<input type="email" class="form-control" placeholder="Email/Username" data-toggle="tooltip" title="This will be your username" name="email">
			    </div>

			    <div class="form-group">
			      	<label>Password</label>
			      	<input type="password" class="form-control" placeholder="Password"  data-toggle="tooltip" title="Remember this is your password" name="password">
			    </div>

			  	<button class="btn btn-primary ladda ladda-button saveBtn" data-url="/admin/save/account" id="ladda" data-size="s" data-style="expand-left"><span class="ladda-label">Create Account</span></button> </span>

			</div>
		</form>
	</div>             
</div>

@stop

@section('js_filtered')
@include('bis.jslinks.js_crud')

@stop