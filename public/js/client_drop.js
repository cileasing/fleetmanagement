var clientContract = document.querySelector('#client_name');
clientContract.addEventListener('change', (e) => getContactName(event));

//Listen to click event for the contact Name
var contactName = document.querySelector('#contact_name');
contactName.addEventListener('change', (e) => getOtherDetails(event));

var action = "http://localhost:8081/get/clientdetails";
var actionContact = "http://localhost:8081/get/contactname";

const getContactName = (event) => {
    let clientName = document.querySelector('#client_name').value;
    
    
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
     
      
    if(clientName == ""){
        toastr.error("Please select a Company");
        return;
    }else{
        var outputVar = "";
        outputVar = '<option value="">Select</option>';
        $.post(action, {clientName: clientName}, function (data) {
          if(data){
           const { result } = data;
              
           outputVar += result.map(el => '<option value="' + el.ID + '">' + el.First_Name + '  ' + el.Last_Name + '</option>');
          /* for (idx=0; idx < data.result.length; idx++) {
                outputVar += '<option value="' + data.result[idx].ID + '">' + data.result[idx].First_Name + '  ' + data.result[idx].Last_Name + '</option>';
               
            } */
                
           document.querySelector('.mySelect').innerHTML = outputVar;
           toastr.success("Good Job!, Now Select Contact",  {timeOut: 15000});
            //document.querySelector('.mySelect').append(outputVar);
          }

       });
    }
    
 }
 
 
 
const getOtherDetails = (event) => {
    let contactName = document.querySelector('#contact_name').value;
    
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
     
      
    if(contactName == ""){
        toastr.error("Please select a Contact Person");
        return;
    }else{
        const contactPhone = "";
         const contactEmail = "";
         
        $.post(actionContact, {contactName: contactName}, function (data) {
          if(data){
             
            
             const { Email, Phone } = data.result[0];
             console.log(Email);
            if( typeof(Email) == "undefined"  || Email == ""){
                toastr.error("It seem you don't have email or phone for the client, don't worry just type it (:",  {timeOut: 15000});
            }else{
            document.querySelector('#contact_email').value = Email;
             document.querySelector('#contact_phone').value = Phone;
             toastr.info("You are on track! No Create your trips :)",  {timeOut: 15000});  
            }
            
             
             
           
          }

       });
    }
    
 }


