var tripClicks = document.querySelector('#add_trips');
tripClicks.addEventListener('click', (e) => pushtrips(e));

var addClickService = document.querySelector('#put');
addClickService.addEventListener('click', (e) => addnewservice(e));

//var clearAll = document.querySelector('#clearAll');
//addClear.addEventListener('click', (e) => clearAllService(e));

const reservationNew = document.querySelector('.box-body');


class HTML {
    //Display error message



    printMessage = (message, className) => {
        const messageWrapper = document.createElement('div');
        messageWrapper.classList.add('text-center', 'alert', className);
        messageWrapper.appendChild(document.createTextNode(message));

        document.querySelector('.reservationNew').insertBefore(messageWrapper, reservationNew);

        setTimeout(function (){
            document.querySelector('.reservationNew .alert').remove();
        }, 3000);
    }


     addService = (add_service_type, quantity, addServiceText) => {

        const add_service = document.querySelector('.add_service_details table');
        //Create the dive to add
        var getCost = add_service_type.split("|");
        var TotalPrice  = Number(getCost[1] * quantity);

        var ServiceText = addServiceText.options[addServiceText.selectedIndex].text

        const add_div = document.createElement('tr');
        add_div.className ="table table-bordered table-responsive table-hovered";
        add_div.innerHTML = `
        <td>${ServiceText}</td>
        <td>${getCost[1]}</td>
        <td>${TotalPrice}</td>
        `;
         return add_service.appendChild(add_div);


    }


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



function addnewservice(e){
   var addService_input = document.getElementById("additional_service").value;
   var quantity = document.getElementById("quantity").value;

      //Get the text of the service type
      var addService__text = document.getElementById('additional_service')
     // var addServiceText = addService__text.options[addService__text.selectedIndex].text

   if(addService_input === '' || quantity === ''){
        alert("please service and cost");
        return;
   }else{
       //Add the expenses into list
       html.addService(addService_input, quantity, addService__text);
   }
}



function pushtrips(e){

   var output = document.getElementById("addedTrips");
   var output_main_trip = document.getElementById("added_main_trips");

   var service_type = document.getElementById("service_type").value;
   var passengerName = document.getElementById("passengerName").value;
   var nof_passenger = document.getElementById("nof_passenger").value;

   var no_of_days = document.getElementById("no_of_days").value;
   var price_per_day = document.getElementById("price_per_day").value;

   var end_date = document.getElementById("end_date").value;
   var pick_up_date = document.getElementById("pick_up_date").value;
   var destination = document.getElementById("destination").value;
   var depature = document.getElementById("depature").value;
   var vehicle_type = document.getElementById("vehicle_type").value;

   //Get the text of the service type
   var service_type_text = document.getElementById('service_type')
   var selectedText = service_type_text.options[service_type_text.selectedIndex].text

   var total_Amount = no_of_days * price_per_day;

   //Make Service Type
   var service_type_description = selectedText+ " |   "+ total_Amount;


   ////////////////////////////////////////// SECOND FUNCTION PARAMS////////////////////////////////////////

   var addService_input = document.getElementById("additional_service").value;
   var quantity = document.getElementById("quantity").value;

      //Get the text of the service type
      var addService__text = document.getElementById('additional_service')
      //var addServiceText = addService__text.options[addService__text.selectedIndex].text

      //var getCost = addService_input.split("|");
     // var TotalPrice  = (getCost[1] * quantity);

      ///////////////////////////////////////// END OF SECOND FUNCTION PARAMS////////////////////////////////////////



   if(service_type === '' || passengerName === ''){
       html.printMessage("There was an error all fields are required", "alert-danger");
        //alert("There was an error all fields are required");
   }else{
       //Add the expenses into list
      html.addTripList(passengerName, pick_up_date, end_date, depature, destination, vehicle_type, service_type_description,
            total_Amount, addService_input, addService__text, quantity);


   }


}

function clearAllService(e){

    var func =  pushtrips(e);
    console.log(func);
 }

function myFunction() {
    var x = document.getElementById("collapse_table");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
