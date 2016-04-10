






/*  alert.JS
|===============================================================================
|   Alert messages from sweet aleert .
|   
|===============================================================================
*/



// GLOBAL SWEET ALERT 
 $(document).ready(function () {
/*
      swal.setDefaults({ 
      showCancelButton: true,
      allowEscapeKey: false,
      showLoaderOnConfirm: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Okay",   
      cancelButtonText: "Cancel",   
      closeOnConfirm: false, 
      allowOutsideClick:false,
      closeOnCancel: false});*/

     });

function check(){

  var isConfirm = true;
  swal({   title: "Are you sure?",   
  text: "You will not be able to recover this imaginary file!",   
  type: "warning",   
  showCancelButton: true,   
  confirmButtonColor: "#DD6B55",   
  confirmButtonText: "Yes, delete it!",   
  cancelButtonText: "No, cancel plx!",   
  closeOnConfirm: true,   
  closeOnCancel: true });
  return isConfirm;
}



function check_default(message){

  var status = swal({   title: "Are you sure?",   
  text: message,   
  type: "warning",   
  showCancelButton: true,   
  confirmButtonColor: "#DD6B55",   
  confirmButtonText: "Yes",   
  cancelButtonText: "No",   
  closeOnConfirm: true,   
  closeOnCancel: true });

  
}

function custom_message(message){
  swal({

    title: "Invalid",   
    text: message,
    type: 'error',
    showConfirmButton: true, 
    showCancelButton: false, 
    animation:true,  
    html: true 
   
});
  return false;
}

function check_manual(){

  var isConfirm = true;
  swal({   title: "Confirmation",   
  text: "Do you want to store barcodes manually?",   
  type: "warning",   
  showCancelButton: true,   
  confirmButtonColor: "#DD6B55",   
  confirmButtonText: "Yes",   
  cancelButtonText: "No",   
  closeOnConfirm: true,   
  closeOnCancel: true });
  
  return isConfirm;
}

function loading(){

   swal.setDefaults({ 
   showCancelButton: true,
   showLoaderOnConfirm: true,   
   confirmButtonColor: "#DD6B55",   
   confirmButtonText: "Okay",   
   cancelButtonText: "Cancel",   
   closeOnConfirm: false,   
   closeOnCancel: false});
}
/*
function fail(message){

  //$('form')[0].reset();

  swal({

    title: "Rockhopper says:",   
    text: message,
    type: 'warning',
    showCancelButton: false, 
    animation:true,  
    html: true 

  });

}*/


function approved(message){


  swal({

    title: "Rockhopper says:",   
    text: message,
    type: 'success',
    showCancelButton: false, 
    animation:true,  
    html: true 
   
});

}


function cancelled(){
  swal({   

    title: "Rockhopper says:",   
    text: "Transaction has been cancelled.",
    showCancelButton: false, 
    animation:true,  
    html: true }); 

}




//notifications 

function successNotif(msg){
  notif({
    msg: msg,
    type: "success",
  });
}


function deniedNotif(msg){
  notif({
    msg: msg,
    type: "error",
  });
}