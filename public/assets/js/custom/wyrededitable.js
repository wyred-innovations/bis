

$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
    var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

    if (token) {
        return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
    }
});

$(document).ready(function(){

	$('.wyred-editable').attr('contenteditable',true);


	$('.wyred-editable').blur(function(){

		editable  = $(this);
		id        = editable.attr('data-id');
		link      = editable.attr('data-link');
		value     = editable.text();
		nextInput = editable.children();

		nextInput.val(value);

		updateEditable();

	});

	function updateEditable(){


		$.ajax( {

	        url: link+'?id='+id+'&value='+value,
	        type: 'POST',
	        processData: false,
	        contentType: false,
	        success:function(data){
           
              	if(data[0] == true){

                	bottom_right_success('alert_message',data[1]);

              	}else if(data[0] == false){

                	bottom_right_fail('alert_message',data[1]);

              	}

            },
              error: function (error) {
             	console.log(error);
          		return false;
              }

        });

    	

	}



});	