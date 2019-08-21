 
//BEGINNING OF MODAL FOR ACCOUNT PAYABLE
$('.confirmVehicle').click(function (e) {
     var dataid = $(this).attr('id');
    
    if(dataid == ""){
         toastr.error("Important Variable to process request missing, Contact IT");
         return;
    }else{
        
        $.ajax({

        url: GLOBALS.appRoot + "reservation/tripdetails/" + dataid,
        type: "GET",
        dataType: "JSON"
        , success: function (data) {
            
           //var output = '';
             $('#eloaddformerror').html('loading trip results, please wait....');
             
             var output = "<small class='category'>TRIPS</small><table class='table table-responsive'><tr><th>Passenger Name</th><th>Pickup Date</th><th>End Date</th>\n\
            <th>Depature</th><th>Destination</th><th>Vehicle Type</th></tr>";
           
            if(data){
               
                const { status } = data;
                
                output += status.map(el => '<tr><td></td></tr>');
                $('#eloaddformerror').html(output);
                
                  output = "</table>";
                
             }else{
                  $('#eloaddformerror').html("We cannot push request at this time, please try again");   
             }
            
         }
     
        });
    
    }
	
});