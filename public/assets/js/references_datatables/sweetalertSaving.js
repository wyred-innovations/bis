function singleUpdate(data){

          var url = $(data).attr("data-url");
          var table_id = $(data).attr("data-table");
          var value = $(data).attr('data-val');
          var title = $(data).attr('data-title');
          var data_id = $(data).attr('data-id');
          var sourceName = $(data).attr('data-sourceName');
          var sourceId = $(data).attr('data-sourceId');
          

          swal({   
            title: "Add New "+title,   
            html: '<p><input class="sweet-alert-input" id="input-save" value="'+value+'">',
            showCancelButton: true,  
            closeOnCancel:true, 
            closeOnConfirm: false,   
            inputPlaceholder:"Write something" }, 

              function(){   

                var inputValue = $('#input-save').val(); 
                
                if (inputValue === false) {
                  return false;      
                }
                if (inputValue === "") 
                { 
                  
                  swal({
                    title:"Rockhopper message:",
                    text: "You shoul write something.",
                    showCancelButton: false
                  });

                  return false ; 
                }  

                  $.ajax( {

                    url: "/"+url+"?id="+data_id+"&newValue="+inputValue+"&sourceName="+sourceName+"&sourceId="+sourceId,
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
                          
                        }
                        else if(data[0] == false)
                        {

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

function singleSave(data){

          var url = $(data).attr("data-url");
          var table_id = $(data).attr("data-table");
          var value = "";
          var title = $(data).attr('data-title');
          var data_id = "";
          var sourceName = $(data).attr('data-sourceName');
          var sourceId = $(data).attr('data-sourceId');
          

          swal({   
            title: "Add New "+title,   
            html: '<p><input class="sweet-alert-input" id="input-save" value="'+value+'">',
            showCancelButton: true,  
            closeOnCancel:true, 
            inputValue: value,
            closeOnConfirm: false,   
            inputPlaceholder:"Write something" }, 

              function(){   

                var inputValue = $('#input-save').val(); 
                
                if (inputValue === false) {
                  return false;      
                }
                if (inputValue === "") 
                { 
                  
                  swal({
                    title:"Rockhopper message:",
                    text: "You shoul write something.",
                    showCancelButton: false
                  });

                  return false ; 
                }  

                  $.ajax( {

                    url: "/"+url+"?id="+data_id+"&newValue="+inputValue+"&sourceName="+sourceName+"&sourceId="+sourceId,
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
                          
                        }
                        else if(data[0] == false)
                        {

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


function singleDelete(data){

          var url = $(data).attr("data-url");
          var table_id = $(data).attr("data-table");
          var data_id = $(data).attr("data-id");
          var value = $(data).attr('data-val');
          var title = $(data).attr('data-title');

          var sourceName = $(data).attr('data-sourceName');
          var sourceId = $(data).attr('data-sourceId');
          

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
                  if (inputValue === "") 
                  { 
                    swal.showInputError("You need to write something!");     
                    return false  ; 
                  }  

                    $.ajax( {

                    url: "/"+url+"?id="+data_id+"&name="+inputValue+"&sourceName="+sourceName+"&sourceId="+sourceId,
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
                        }
                        else if(data[0] == false)
                        {
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

