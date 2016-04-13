 $(function() {

        $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
            var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
            }
        });

        $('.ladda-report').click(function(e){
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
             
                	runBarGraph(data);


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


 function runBarGraph(data){

      event.preventDefault();




      var year  = new Array();
      var income  = new Array();
      var expenses  = new Array();

      var totalIncome = 0;
      var finalIncome = new Array();


      var totalExpenses = 0;
      var finalExpenses = new Array();

      var tempYear = "";
      var final_year  = new Array();

      console.log(data);

      for(i=0; i <= data.length - 1;i++){

          year[i] = data[i].year;

          average = parseFloat(data[i].income_start) + parseFloat(data[i].income_end) ;
          income = average/2;
  
          average = parseFloat(data[i].expenses_start) + parseFloat(data[i].expenses_end) ;
          expenses = average/2;
          
          console.log(income);

          if(i == 0){

            tempYear = year[i];

            totalIncome += parseFloat(income);
            totalExpenses += parseFloat(expenses);            

          }else{


                if(year[i] != tempYear){

                    tempYear = year[i];

                    final_year.push(tempYear);
                    finalIncome.push(totalIncome);
                    finalExpenses.push(totalExpenses);

                    totalIncome = 0;
                    totalExpenses = 0;

                }else{

                    totalIncome += parseFloat(income);
                    totalExpenses += parseFloat(expenses);
                    
                }

          }

      }

      console.log(finalIncome);
      

      var barChartData = {
          labels: final_year,
          datasets: [
            {
              label: "Income",
              fillColor: "#C8236C",
              strokeColor: "#C8236C",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#C8236C",
              pointHighlightFill: "#C8236C",
              pointHighlightStroke: "#C8236C",
              data: finalExpenses
            },
            {
              label: "Expenses",
              fillColor: "#23ADC8",
              strokeColor: "#23ADC8",
              pointColor: "#23ADC8",
              pointStrokeColor: "#23ADC8",
              pointHighlightFill: "#23ADC8",
              pointHighlightStroke: "#23ADC8",
              data: finalIncome
            }
          ]
        };

        var barchartNew = '<div><canvas id="barCharts" ></canvas></div>';
        
        $('#barCharts').remove();
        $('#barchartContainer').append(barchartNew);

        var barChartCanvas = $("#barCharts").get(0).getContext("2d");

        var barChart = new Chart(barChartCanvas);
        var barChartData = barChartData;

        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 5,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 1,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 4,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 3,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

      
      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);
 }

 /*char development ni*/