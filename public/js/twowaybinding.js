var departure = document.querySelector('#depature');
departure.addEventListener('change', (e) => getdeparture(e));

var destination = document.querySelector('#destination');
destination.addEventListener('change', (e) => getdeparture(e));

var vehicleCategory = document.querySelector('#vehicle_type');
vehicleCategory.addEventListener('change', (e) => checkVehiclePrice(e));


   
var actionStartprice = "http://localhost:8081/get/price";

function getdeparture(e) {
   
    var depart_value = $('#depature').val();
    var dest_value = document.getElementById('destination').value;
    var vehicle_type = document.querySelector('#vehicle_type').value;

   if(depart_value == "" || dest_value == ""){
        toastr.info("Please select both Departure and Location");
   }else if(vehicle_type === ""){
        toastr.error("Please select a vehicle cateogry");
   }
}

const checkVehiclePrice = (event) => {  
   
    var depart_value = $('#depature').val();
    var dest_value = document.getElementById('destination').value;
    var vehicle_type = document.querySelector('#vehicle_type').value;
    var client_id = document.querySelector('#client_id').value;

    if(depart_value && dest_value && vehicle_type ){
        
        checkpriceList(depart_value, dest_value, vehicle_type, client_id);
    }else{
         toastr.error("Please make sure departure, destination and category is selected");
    }
}


const checkpriceList = (depart_value, dest_value, vehicle_type, client_id) => {  
     
    const postData = {
         depature : depart_value,
         destination : dest_value,
         vehicle_type: vehicle_type,
         cid : client_id,
     }
       $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
     
      $.post(actionStartprice, postData, function (data) {
         
            if(data.status == 200){
              var dCost = document.querySelector(".cost").innerHTML = "Price : " + data.cost;
              //var hiddenVar = $(".pushPrice").val(data.cost);
               var hiddenVar2 = document.querySelector('.price_per_day').value = data.cost;
              console.log(hiddenVar2);
             //document.getElementById(".cost").style.textAlign = "right";
            }
        })
}



$("#pick_up_date").change(function(){
//$("#pick_up_date").keyup(function(){
      
    var depart_value = $('#depature').val();
    var dest_value = document.getElementById('destination').value;
    var vehicle_type = document.querySelector('#vehicle_type').value;
    
    var pickDate = document.querySelector('#pick_up_date').value;
    var endDate = document.querySelector('#end_date');
    
    if(dest_value == "" || dest_value == "" || vehicle_type == ""){
        toastr.error("Please make sure you have selected depature, destination and vehicle type to proceed");
        return;
    }else if(pickDate > endDate){
         toastr.error("Pickup Date Cannot be greater than endDate");
        return;
    }
});



$("#end_date").change(function(){
//$("#pick_up_date").keyup(function(){
      
    var depart_value = $('#depature').val();
    var dest_value = document.getElementById('destination').value;
    var vehicle_type = document.querySelector('#vehicle_type').value;
    
    var pickDate = document.querySelector('#pick_up_date').value;
    var endDate = document.querySelector('#end_date').value;
    var price_per_day = document.querySelector('.price_per_day').value;
    
    if(dest_value == "" || dest_value == "" || vehicle_type == ""){
        toastr.error("Please make sure you have selected depature, destination and vehicle type to proceed");
    }else if(pickDate > endDate){
         toastr.error("Pickup Date Cannot be more than End Date");
    }else{
            //pushPrice
      const timeDiff  = (new Date(endDate)) - (new Date(pickDate));
      daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
      
      var pushPrice = document.querySelector(".price_per_day").value;
      var newPrice = pushPrice * daysDiff;
      
      toastr.info("Total Number of Days is " + daysDiff + " * " + pushPrice);
     
      var hiddenVar2 = document.querySelector('.price_per_day').value = newPrice;
      var number_of_days = document.querySelector('.number_of_days').value = daysDiff;
      
      var dCost = document.querySelector(".cost").innerHTML = "Price : " + newPrice;
      //console.log(hiddenVar2);
            
       
    }
});





$("#additional_cost").change(function(e){
//$("#pick_up_date").keyup(function(){
      
    var depart_value = $('#depature').val();
    var dest_value = document.getElementById('destination').value;
    var vehicle_type = document.querySelector('#vehicle_type').value;
    
    var pickDate = document.querySelector('#pick_up_date').value;
    var endDate = document.querySelector('#end_date').value;
    var pushPrice = document.querySelector('.price_per_day').value;
    
    if(dest_value == "" || dest_value == "" || vehicle_type == ""){
        toastr.error("Please make sure you have selected depature, destination and vehicle type to proceed");
    }else if(pickDate > endDate){
         toastr.error("Pickup Date Cannot be more than End Date");
    }else if (pickDate == "" || endDate == ""){
         toastr.error("Please select pickup Date and end Date");
    }else{
     
      var hiddenVar3 = document.querySelector('.price_per_day').value;
      var addCost = document.querySelector('#additional_cost').value;
      var addService = Number(hiddenVar3) + Number(addCost);
      var dCost = document.querySelector(".cost").innerHTML = "Price : " + addService;
      
      var totalCost = document.querySelector('#total_cost').value = addService;
     
       
    }
});

