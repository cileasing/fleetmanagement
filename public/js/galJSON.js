$(document).ready(function () {
    
     var url =   document.URL;
     var strin_split = url.split("/");
     var mainUrl = strin_split[4];
     
     $('#fromgalooli').html('<h5>Loading Data from Galooli Server, please wait....</h5>');
    $.ajax({
        url: GLOBALS.appRoot + "getallgalaloolivehicles",
        type: "GET",
        dataType: "JSON",
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          
        success: function (data) {
             $('#fromgalooli').html('Sucess, Fetching result, please wait....');
              // $('#fromgalooli').html("<img src='http://localhost:8081/images/meload.gif'");
           //  var output = '<label>Vehicle Name: </label> <small style="color:grey; margin-left:10px">(format : AKD 736 MU)</small>'
             //output += '<form name="galoliform" id="galoliform" onSubmit="return false;">\n\
               // <span id="closeerror">';
           
            if(typeof data.CommonResult == "object"){
               
             /*  output += '<select class="form-control select2" style="width: 100%;" id="vehicleName" name="vehicleName">';
                 var icount = data.CommonResult.DataSet.length;
                 //alert(data.CommonResult.DataSet[0][1]);
                       
                for (var idx = 0; idx < data.CommonResult.DataSet.length; ++idx) {
                    output += '<option value="'+ data.CommonResult.DataSet[idx][12] + '-'+ data.CommonResult.DataSet[idx][11] + '-'+ data.CommonResult.DataSet[idx][5] + ' ">'+ data.CommonResult.DataSet[idx][12] + '</option>';
                    //var mileage_km = data.CommonResult.DataSet[idx][11];
                   // var fuel_tank_level = data.CommonResult.DataSet[idx][3];
                   
                }
                output += '</select>';
                  output += '<center><br/><input type="hidden" name="dType" id="dType" value="maintenance" /><button hidden id="synDepreciation" type="submit" onClick="process()" class="btn btn-primary btn-fill btn-xs">Process</button></center<br/>\n\
                    </form>';
                $('#fromgalooli').html(output);
                
                */
                 for (var i = 0; i < data.CommonResult.DataSet.length; ++i) {
                    //select2-vehicleName-container
                     $('#vehic_name').append('<option value="'+ data.CommonResult.DataSet[i][12] + '-'+ data.CommonResult.DataSet[i][11] + '-'+ data.CommonResult.DataSet[i][5] + ' ">'+ data.CommonResult.DataSet[i][12] + '</option>');
                    //output2 += '<option value="'+ data.CommonResult.DataSet[i][12] + '-'+ data.CommonResult.DataSet[i][11] + '-'+ data.CommonResult.DataSet[i][5] + ' ">'+ data.CommonResult.DataSet[i][12] + '</option>';
                }
                
                   $('#fromgalooli').html('');
                   
                
                }else{
                   $('#fromgalooli').html("<center><h4>"+data.CommonResult.ResultDescription+"</h4></center>"); 
                }
                
               
              
                   
              
            }
         }).fail(function () {
         $('#fromgalooli').html("<br/>Error Fetching Result from Galooli, Please try again later....");
            
            })
            
});

//var btnpostmodule = document.querySelector('#postmodule');
//btnpostmodule.addEventListener('click', (e) => getjsonproperties(event));


function process(){
    //var vehicleName = $('#vehicleName').val();
     var vehic_name = $('#vehic_name').val();
   // var mileage = $('#mileage_km').val();
   // var fuel_tank_level = $('#fuel_tank_level').val();
    
    //alert("vehicle Name" + vehicleName );
   // var action = GLOBALS.appRoot + "postformaintenance"; 
    var dataString = new FormData(document.getElementById('galoliform')); //postArticles
    if(vehic_name === ""){
        alert("Please select a vehicle");
    }else{
        
      $.ajax({
        url:  GLOBALS.appRoot + "postformaintenance",
        type: "POST",
        data: dataString,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'JSON',
        
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
             $('#fromgalooli').html('Processing Data, please wait....');
                if(data.status === 200){
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "form/fleet_maintenance_requests?vehicle_id="+data.vehicle_name+"&mileage_km="+data.milleage_km+"&fuel_level="+data.fuel_level+""} , 100);
                 }
            }
         }).fail(function () {
         $('#fromgalooli').html("<br/>Error Process Data Please try again later....");
            
            })
        
       
    }
}

