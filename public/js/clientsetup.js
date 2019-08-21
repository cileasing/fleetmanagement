
const btnsetupClient = document.querySelector('#setupClient');
btnsetupClient.addEventListener('click', (e) => setupOwner(event));

let addowner = GLOBALS.appRoot + "client/add";

const setupOwner = (event) => {
    event.preventDefault();
    const clientName = document.querySelector('#clientName').value;
    const dStatus = document.querySelector('#dStatus').value;
   
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    const data = {
        clientName: clientName,
        dStatus: dStatus,
       
    }

   if(data.clientName == "" || data.dStatus == ""){
       toastr.error("You need to fill this form please");
   }else{
       

       $.post(addowner, data, function (data) {
             if(data.status == 200){
                 let newHtml, html;
                 let hplace = document.getElementById("contract_list");
                  html = '<tr><td>#</td><td>%contract%</td><td>%progress%</td><td>%label%</td></tr>';
                  //newHtml = html.replace('%id%', "new");
                   newHtml = html.replace('%contract%', clientName);
                  newHtml = newHtml.replace('%progress%', "");
                  newHtml = newHtml.replace('%label%', dStatus);
                  hplace.insertAdjacentHTML('afterbegin', newHtml);
                  toastr.success("Ownder Successfully Added");
                  document.querySelector('#ownerName').value ="";
                  document.querySelector('#dStatus').value="";
                 
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed");
             }
         }); 
        
    }
}