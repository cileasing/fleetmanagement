const save_reserve = document.querySelector('#save_reservation');
save_reserve.addEventListener('click', (e) => saveDetails(e));

let reservation_table = GLOBALS.appRoot + "reserve/store";

saveDetails = (e) => {

    var datepicker = document.getElementById("datepicker").value;
    var office = document.getElementById("office").value;
    var client_type = document.getElementById("client_type").value;
    var credit_type = document.getElementById("credit_type").value;
    var client_name = document.getElementById("client_name").value;
    var contact_name = document.getElementById("contact_name").value;
    var contact_email = document.getElementById("contact_email").value;
    var contact_phone = document.getElementById("contact_phone").value;
    var comment = document.getElementById("comment").value;
    var dStatus = document.getElementById("dStatus").value;

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

        var d = new Date();
        
    const postData = {
        reservation_date: datepicker,
        office: office,
        client_type: client_type,
        credit_type: credit_type,
        client_name: client_name,
        contact_name: contact_name,
        contact_email_address: contact_email,
        contact_phone_number: contact_phone,
        comment: comment,
        task_status: dStatus,
        random_num: Math.random().toString(36).replace(/[^a-z0-9_]+/g, '').substr(2, 100)  + d.getTime() + d.getSeconds() + d.getMilliseconds() +
                 +  Math.floor((Math.random() * 100) + 10)
        //(Math.random().toString(36).substring(2, 16) + Math.random().toString(36).substring(2, 16)).toUpperCase()
    }

    if(office == "" || client_type == ""  || credit_type == ""){
        toastr.error("Please make sure Office, Client Type and Credit Type is not Empty", {timeOut: 50000});
    }else if(client_name == ""){
        toastr.error("Please select a client", {timeOut: 50000});
    }else{
        toastr.info("Please wait, processing request...");
        save_reserve.style.display = 'none';;
        $.post(reservation_table, postData, function (data) {
            if(data.status == 200){
                 toastr.success("Reservation Added.");
                setTimeout(function(){window.top.location= GLOBALS.appRoot + "add/trips/" + postData.random_num} , 100);
            }
        })
    }
}

