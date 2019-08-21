var tripClicks = document.querySelector('#add_trips');
tripClicks.addEventListener('click', (e) => pushtrips(e));

//var addClickService = document.querySelector('#put');
//addClickService.addEventListener('click', (e) => addnewservice(e));

//var clearAll = document.querySelector('#clearAll');
//addClear.addEventListener('click', (e) => clearAllService(e));

const reservationNew = document.querySelector('.box-body');


class HTML {
   


     addTripList = (passengerName, pick_up_date, end_date, depature, destination, vehicle_type, service_type,
            price_per_day, addService_input, addServiceText, TotalPrice) => {

        const tripsadded = document.querySelector('.added_main_trips table');
        //each trip will be a table
        const tr = document.createElement('tr');


        //const others = this.addService(addService_input, TotalPrice, addServiceText);



        tr.className ="table table-bordered table-responsive table-hovered";
        tr.innerHTML = `
            <td>${passengerName}</td>
            <td><span class="badge badge-secondary badge-pill">${pick_up_date}</span></td>
            <td><span class="badge badge-primary">${end_date}</span></td>
            <td>${depature}</td>
            <td>${destination}</td>
            <td>${vehicle_type}</td>
            <td>${service_type}   </td>
            <td>${price_per_day}</td>
            <td></td>
        `;

        tripsadded.appendChild(tr);

        console.log(tripsadded);

    }
}

const html = new HTML();




function pushtrips(e){
  
   var output = document.getElementById("addedTrips");
   var output_main_trip = document.getElementById("added_main_trips");

   var service_type = document.getElementById("service_type").value;
   var passengerName = document.getElementById("passengerName").value;
   var nof_passenger = document.getElementById("nof_passenger").value;

   var number_of_days = document.getElementById("number_of_days").value;
   var price_per_day = document.getElementById("price_per_day").value;

   var end_date = document.getElementById("end_date").value;
   var pick_up_date = document.getElementById("pick_up_date").value;
   var destination = document.getElementById("destination").value;
   var depature = document.getElementById("depature").value;
   var vehicle_type = document.getElementById("vehicle_type").value;
   var total_cost = document.getElementById("total_cost").value;

   //Get the text of the service type
   var service_type_text = document.getElementById('service_type')
   var selectedText = service_type_text.options[service_type_text.selectedIndex].text

   //var total_Amount = no_of_days * price_per_day;

   //Make Service Type
   //var service_type_description = selectedText+ " |   "+ total_Amount;
   
   var service_type_description = selectedText+ " |   "+ total_cost;


   ////////////////////////////////////////// SECOND FUNCTION PARAMS////////////////////////////////////////

   var addService_input = document.getElementById("additional_service").value;
   var quantity = document.getElementById("quantity").value;

   //Get the text of the service type
   var addService__text = document.getElementById('additional_service')
   
   
   ////////////////////////////////PROCESSING ADDITIONAL SERVICE ///////////////////////////////////////////
     var addService_input = document.getElementById("additional_service").value;
     var quantity = document.getElementById("quantity").value;
      var add_cost = document.getElementById("add_cost").value;
      //Get the text of the service type
     var addService__text = document.getElementById('additional_service');
     var selectedText = service_type_text.options[service_type_text.selectedIndex].text
   
    var names = document.getElementsByName('additional_service[]');

    $fullService = "";
    for(key=0; key < names.length; key++)  {
      $fullService += names[key].value;  
    }
   
  /////////////////////////////////// END OF ADDITIONAL SERVICE /////////////////////////////////////////////
  

     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
   let add_trips = GLOBALS.appRoot + "trip/save";
   
   if(service_type === '' || passengerName === ''){
     toastr.error("Please Select Service Typ and Add Name", {timeOut: 1000});
   }else{
     toastr.info("Addition Trip, Please wait...", {timeOut: 100});
         
     //Post To Detabase
     $.post(add_trips, $('#trip_information').serialize(), function (data) {
         
            if(data.status == 200){
               toastr.success("Trips Successfully Added", {timeOut: 1000});
               
             setTimeout(function () { window.location.reload(1); }, 100);
             //html.addTripList(passengerName, pick_up_date, end_date, depature, destination, vehicle_type, service_type_description,
               //total_Amount, addService_input, addService__text, quantity);
              
            }
        })
       //Add the expenses into list
     
      


   }


}

function myFunction() {
    var x = document.getElementById("collapse_table");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
