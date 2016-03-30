// need to minimize code

$(".rrd_form").submit(function(e) { 

	e.preventDefault();  

	var rrd_form = $(this)
	var url = $(this).attr("data-url");
	var table_id = $(this).attr("data-table");

	var formData = new FormData($(this)[0]);
	
	if( $(this).parsley().isValid() ) {

			swal({   
               title: "Are you sure?",   
               text: "",   
               showCancelButton: true,
               
               type: "warning"
                }, 

		        function(isConfirm){  

		          	if (isConfirm) {  

		                general_ajax(url,formData,table_id,rrd_form);
		               	
						
		            }

		            else{ 

		                cancelled();   
		            }
		          });	
	}
	else{
		custom_message('Some fields are required. Check form, and try again.');
	}	
});


general_ajax = function(url,formData,table_id,rrd_form) {
      
      $.ajax( {

        url: "/"+url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success:function(data){

            if(data[0] == true){

              approved(data[1]);
              $(rrd_form)[0].reset();

              var modal_id = $('.rrd_form').parents('div').last().attr('id');

              //$('#'+modal_id+'').hide('modal');
              
              try {

                var func = table_id;
                
                window[func]();

              }catch (e) {

                console.log("error no table to refresh proceeding to next");
              
              }
              
              //table_refresh(table_id);
              //return refresh_table('update_plantilla');      
            }
            else if(data[0] == false)
            {

              fail(data[1]);

            }else{
              swal.close();
            }

        
        },error:function(){ 
            swal.close();
        }

      });
}



$(".person_saving").submit(function(e) { 

  e.preventDefault();  

  var rrd_form = $(this)
  var url = $(this).attr("data-url");
  var table_id = $(this).attr("data-table");

  var formData = new FormData($(this)[0]);
  
  if( $(this).parsley().isValid() ) {

      swal({   
               title: "Are you sure?",   
               text: "",   
               showCancelButton: true,
               type: "warning"
                }, 

            function(isConfirm){  

                if (isConfirm) {  

                    general_ajax(url,formData,table_id,rrd_form);
                    $('#camView').html('');
            
                }

                else{ 

                    cancelled();   
                }
              }); 
  }
  else{
    custom_message('Some fields are required. Check form, and try again.');
  } 
});





//only for profile cause this reloads the page
$(".profileSaving").submit(function(e) { 

  e.preventDefault();  

  var rrd_form = $(this)
  var url = $(this).attr("data-url");
  var table_id = $(this).attr("data-table");

  var formData = new FormData($(this)[0]);
  
  if( $(this).parsley().isValid() ) {

      swal({   
               title: "Are you sure?",   
               text: "",   
               showCancelButton: true,
               type: "warning"
                }, 

            function(isConfirm){  

                if (isConfirm) {  

                    save_profile(url,formData,table_id,rrd_form);
                    
            
                }

                else{ 

                    cancelled();   
                }
              }); 
  }
  else{
    custom_message('Some fields are required. Check form, and try again.');
  } 
});


save_profile = function(url,formData,table_id,rrd_form) {
      
      $.ajax( {

        url: "/"+url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success:function(data){

            if(data[0] == true){

              approved(data[1]);
              $(rrd_form)[0].reset();

              var modal_id = $('.rrd_form').parents('div').last().attr('id');

              //$('#'+modal_id+'').hide('modal');
              
              try {

                var func = table_id;
                
                window[func]();

              }catch (e) {

                console.log("error no table to refresh proceeding to next");
              
              }
              
              location.reload();
              //table_refresh(table_id);
              //return refresh_table('update_plantilla');      
            }
            else if(data[0] == false)
            {

              fail(data[1]);

            }else{
              swal.close();
            }

        
        },error:function(){ 
            swal.close();
        }

      });
}