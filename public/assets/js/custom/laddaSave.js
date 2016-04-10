 $(function() {
        $('.ladda').click(function(e){
          e.preventDefault();

          var button = $(this);
          var url  = $(this).attr('data-url');
          var form = $(this).parents('form:first');
          var data = new FormData($(form)[0]);
	      
	      console.log(form);

	      formValidate = $(form);

		  formValidate.validate({
		          ignoreTitle: true,
		          debug:true
		  });
		 

          if(!formValidate.valid()){
				fail('alert_message','Some input fields is highly required. Please write something to resume.');
          		
          		var errorInput = $(formValidate).find("input.error")[0];

          	try{
          		$('html, body').animate({
			         scrollTop: ($(errorInput).offset().top - 300)
			    }, 2000);
          	}catch(e){

          	}
          		

          		return false;

          }

          if($(button).hasClass('disabled')){
          		
          		return false;//disable 
          }



          var l = Ladda.create(this);
          l.start();
          $('#loading').show();
          $.ajax( {

	        url: url,
	        type: 'POST',
	        data: data,
	        processData: false,
	        contentType: false,
	        success:function(data){
           
             
              	if(data[0] == true){

                	success('alert_message',data[1]);
                	//$(form)[0].reset();

              	}else if(data[0] == false){

                	fail('alert_message',data[1]);

              	}

              	var oldVal = $(button).val();
	            $(button).val("Processing Please wait");
	            $(button).addClass("disabled");


	            setTimeout(function(){
	            	
	            	$(button).val(oldVal);
	            	$(button).removeClass("disabled");
				}, 3000)
				$('#loading').hide();
	            l.stop();
            },
              error: function (error) {
                l.stop();
                $('#error').show();
                $('#loading').hide();
          		return false;
              }

        });

    	});
    });


	

    function success(id,message){

		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-top-center",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}

		toastr["success"](message)

    }

    function bottom_right_success(id,message){

		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-bottom-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}

		toastr["success"](message)

    }

    function bottom_right_fail(id,message){
    	
        toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-bottom-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}

		toastr["warning"](message)

	}


    function fail(id,message){
    	
        toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-top-center",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}


		toastr["warning"](message)
    }