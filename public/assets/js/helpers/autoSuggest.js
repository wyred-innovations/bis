   
    $('.autoSuggest').keyup(function(){

          var data_url = $(this).attr('data-url');
          var data_display = $(this).attr('data-display');

          var obj = {display: data_display};
          var display = obj['display'];
          var data_filter='';
          
          if(data_display == 'province_name'){
            data_filter = $(this).attr('data-filter');
          }
          if(data_display == 'municipality_name'){
            data_filter = $(this).attr('data-filter');
          }
          
          $( this ).autocomplete({
              source: data_url+'?inputVal='+$(this).val()+'&data_filter='+data_filter,
              minLength: 0,

              select: function( event, ui ) {

                  $( this ).val( ui.item[display]);
                  return false;
              }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
             
                return $( "<li>" )
                .append( "<a>" + item[display]  + "</a>" )
                .appendTo( ul );
              
              
            };
          });
