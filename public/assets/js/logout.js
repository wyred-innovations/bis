function logout(){       

          swal({   title: "Are you sure?",   
            text: "Click YES to logout, otherwise click NO.",   
            type: "warning",  
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "YES!",   
            cancelButtonText: "NO, maybe later!",   
            closeOnConfirm: false,   
            closeOnCancel: false }, 
            

            function(isConfirm){   

              if (isConfirm) {     
                        window.location.href = "/auth/logout";
              } else 

              {     

               swal({   title: "Logout has been cancelled!",   
                type: "success",   
                imageUrl: "/system/img/down_reduced.png",
                imageSize:"200x200",
                showCancelButton: false
                 });

              } });
 }