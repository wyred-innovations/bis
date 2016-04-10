

function showAttr(){
	var help = true;

	if(help == true){
		$("form .form-control").each(function() {
		    $(this).hover(function(){
		        var name = $(this).attr('name');
		        var id = $(this).attr('id');
		        $(this).attr('title',"name = "+name+ " id= "+id)
		    });
		});
	}
}