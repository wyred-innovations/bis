
function select_binder(reference, select_id, src_id, src_name , filter_id ){

      if(filter_id == null){
          filter_id = "";
      }
  
      $.ajax( {
        url: "/select_binder",
        type: 'POST',
        data: { reference: reference , filter_id: filter_id },
        async: false,
        success:function(data){
            
            data = $.parseJSON(data);
            
            var select = $("."+select_id), options = '';
            select.empty();      
            options += "<option value=''></option>";

            for(var i=0;i <data.length; i++)
              {

               options += "<option row-id='"+data[i].row_id+"' value='"+data[i][src_id]+"'>"+data[i][src_name]+"</option>";              
              }
          
            select.append(options);
        }

      });

      
}



function select_binderSec(reference,select_id,src_id,src_name,filter_id){

      if(filter_id == null){
          filter_id = "";
      }
  
      $.ajax( {
        url: "/select_binderSec",
        type: 'POST',
        data: { reference: reference , filter_id: filter_id },
        async: false,
        success:function(data){
            
            data = $.parseJSON(data);
            console.log("Employees.");
            console.log(data);
            
            var select = $("."+select_id), options = '';
            select.empty();      
            options += "<option value=''></option>";

            for(var i=0;i <data.length; i++)
              {

               options += "<option row-id='"+data[i].row_id+"' value='"+data[i][src_id]+"'>"+data[i][src_name]+"</option>";              
              }
          
            select.append(options);
        }

      });

      
}






function list_binder(reference,list_class,src_name,filter_id){

      if(filter_id == null){
          filter_id = "";
      }
  
      $.ajax( {
        url: "/list_binder",
        type: 'POST',
        data: { reference: reference , filter_id: filter_id },
        async: false,
        success:function(data){
            
            data = $.parseJSON(data);
            
            var list = $("."+list_class), options = '';
            list.empty();    
            options += "<option value=''>";

            for(var i=0;i <data.length; i++)
              {
               options += "<option value='"+data[i][src_name]+"'>";              
              }
          
            list.append(options);
        }

      });

      
}