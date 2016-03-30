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

            if(data[0] == "true"){

              approved(data[1]);
              $(rrd_form)[0].reset();
              
              try {

                window[table_id]();

              }catch (e) {

                console.log("error no table to refresh proceeding to next");
              
              }

              
              table_refresh(table_id);
              //return refresh_table('update_plantilla');      
            }
            else
            {

              setTimeout(function() {

                }, 1000);
                fail(data[1]);

            }

        
        },error:function(){ 
            swal.close();
        }

      });
}