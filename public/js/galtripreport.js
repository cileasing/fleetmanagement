$(document).ready(function () {
     var url =   document.URL;
     var strin_split = url.split("/");
     var mainUrl = strin_split[4];
     var query = "";
     var startDate = new Date();
     var dMonth = startDate.getMonth() + 1;
    
     var fullStartDate = startDate.getFullYear()+"-"+ dMonth+"-"+ startDate.getDate()
    
     
    var endDate = new Date();
    
    var idYear = endDate.getFullYear();
    var idMonth = endDate.getMonth() + 1;
    var idDay = endDate.getDay() + 1;
     
     var fullEndDate = endDate.getFullYear()+"-" + idMonth+"-"+ endDate.getDate()
    
   // alert(fullStartDate + " " + fullEndDate);
     $('#fromgalooli').html('<center><img src="http://localhost:8081/images/meload.gif"/></center><br/>');
    $.ajax({
        url: "https://sdk.galooli-systems.com/galooliSDKService.svc/json/Trip_Report?userName=Oladejo%20Lasisi&password=lasisi@234&requestedUnits=&startDate="+fullStartDate+"&endDate="+fullEndDate+"&requestedPropertiesStr=a.id,u.plate_number,u.main_fuel_tank_capacity,u.main_fuel_tank_minimum_level,u.main_fuel_tank_capacity_-_n,u.main_fuel_tank_minimum_level_-_n,u.main_fuel_calibration,u.main_fuel_mode,u.fuel_per_hour_preset,u.fuel_per_distance_preset,u.distance_per_fuel_preset,go0.geofence_name,go0.geofence_description,go0.geofence_center_latitude,go0.geofence_center_longitude,go1.geofence_name,go1.geofence_center_latitude,go1.geofence_center_longitude,s.max_speed,s.over_speed_distance,s.over_speed_time,sc.start_time,sc.end_time,sc.total_distance,f.cost_per_liter,ac.time,ac.gps_time,ac.latitude,ac.longitude,ac.distance,ac.speed,ac.main_fuel_tank_level,ac.main_fuel_tank_full,u.name,c.assigned_fleet",
        type: "GET",
        dataType: "JSON",
          
        success: function (data) {
       
             $('#fromgalooli').html('Sucess, Fetching result, please wait....');
             var output = '<form>';
           
            if(typeof data.CommonResult == "object"){
                
                output +='<table class="table"><tr><th>Vehicle Name</th><th>Plate Number</th><th>F/Tank Capacity</th><th>Fuel Level</th><th>Milleage</th><th>Speed</th><th>Longitude</th><th>Latitude</th></tr>';
              
                
                for (var idx = 0; idx < data.CommonResult.DataSet.length; ++idx) {
                    output += '<tr><td>'+data.CommonResult.DataSet[idx][1]+'</td><td>'+data.CommonResult.DataSet[idx][33]+'</td><td>'+data.CommonResult.DataSet[idx][2]+'</td>\n\
                    <td>'+data.CommonResult.DataSet[idx][30]+'</td><td>'+data.CommonResult.DataSet[idx][29]+'</td><td>'+data.CommonResult.DataSet[idx][30]+'</td>\n\
                    <td>'+data.CommonResult.DataSet[idx][27]+'</td><td>'+data.CommonResult.DataSet[idx][28]+'</td></tr>'; 
                }
              
               
                
                output += '</table></form>';
                $('#fromgalooli').html(output);
                
                }else{
                   $('#fromgalooli').html("<center><h4>"+data.CommonResult.ResultDescription+"</h4></center>"); 
                }
               
               processtoDB(data.CommonResult.DataSet, mainUrl);
            }
         }).fail(function () {
         $('#fromgalooli').html("<br/>Error Fetching Result from Galooli, Please try again later....");
            
            })
            
});


function processtoDB(data, mainUrl){
  
  var action = GLOBALS.appRoot + "savejson/asobject"; 
    //var action = "http://localhost:8000/savejson/asobject";  
   
    //var type = "asset-report";
      if(typeof data != "object" && data == ""){ 
        console.log("No data to process");
    }else{
        console.log(data);
    /* $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); */
        var data = JSON.stringify(data);
         $.post(action, {data: data, mainUrl: mainUrl}, function (data) {
             if(data.status == 200){
                 console.log("Success");
             //  setTimeout(function(){window.top.location= GLOBALS.appRoot + "form/fleet_maintenance_requests?vehicle_id='"+vehicleName+"'&mileage_km='"+mileage+"'&fuel_tank_level='"+fuel_tank_level+"'"} , 100);
             }
         }); 
        
    }
}

////////////////////////////////////////////////  GALOOLI PROCESS MODULE ////////////////////////////////////////////////

