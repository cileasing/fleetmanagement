$(document).ready(function () {
    
     var url =   document.URL;
     var strin_split = url.split("/");
     var mainUrl = strin_split[4];
     
     $('#fromgalooli').html('<h5>Loading Data from Galooli Server, please wait....</h5>');
    $.ajax({
        url: "https://sdk.galooli-systems.com/galooliSDKService.svc/json/Assets_Report?userName=Oladejo%20Lasisi&password=lasisi@234&requestedPropertiesStr=o.name,u.plate_number,u.vehicle_color,ac.latitude,ac.longitude,ac.main_fuel_tank_level,g.name,g.description,a.company,a.type,ac.speed,ac.distance,u.name&lastGmtUpdateTime=2000-01-01%2000:00:00",
        type: "GET",
        dataType: "JSON",
          
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
                         //return
                for (var idx = 0; idx < data.CommonResult.DataSet.length; ++idx) {
                    output += '<option value="'+ data.CommonResult.DataSet[idx][12] + '">'+ data.CommonResult.DataSet[idx][12] + ' </option>';
                    var mileage_km = data.CommonResult.DataSet[idx][1];
                    var fuel_tank_level = data.CommonResult.DataSet[idx][5];
                }
                  output += '</select> <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"><input type="hidden" id="mileage_km" name="mileage_km" value="'+ mileage_km +' "/>\n\
                            <input type="hidden" id="fuel_tank_level" name="fuel_tank_level" value="'+ fuel_tank_level +' "/><br/>\n\
                        <center><button hidden id="synDepreciation" type="submit" onClick="process()" class="btn btn-primary btn-fill btn-xs">Process</button></center<br/>\n\
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
                
              //processtoDB(data.CommonResult.DataSet, mainUrl);
              processtoDB(data, mainUrl);
            }
         }).fail(function () {
         $('#fromgalooli').html("<br/>Error Fetching Result from Galooli, Please try again later....");
            
            })
            
});

//var btnpostmodule = document.querySelector('#postmodule');
//btnpostmodule.addEventListener('click', (e) => getjsonproperties(event));




function processtoDB(data, mainUrl){
  
    var action = GLOBALS.appRoot + "savejson/asobject"; 
   // var action = "http://localhost:8081/savejson/asobject";  
   
    //var mainUrl = "asset-report";
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
         $.post(action, {data: data, mainUrl : mainUrl}, function (data) {
             if(data.status == 200){
                 console.log("Success");
             //  setTimeout(function(){window.top.location= GLOBALS.appRoot + "form/fleet_maintenance_requests?vehicle_id='"+vehicleName+"'&mileage_km='"+mileage+"'&fuel_tank_level='"+fuel_tank_level+"'"} , 100);
             }
         }); 
        
    }
}

////////////////////////////////////////////////  GALOOLI PROCESS MODULE ////////////////////////////////////////////////

