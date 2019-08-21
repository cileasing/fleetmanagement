
const btnsetupContract = document.querySelector('#setupContract');
btnsetupContract.addEventListener('click', (e) => setupContract(event));

let addcontraction = GLOBALS.appRoot + "contract/store";

const setupContract = (event) => {
    event.preventDefault();
    const contractName = document.querySelector('#contractName').value;
    const dStatus = document.querySelector('#dStatus').value;
    //const token = document.querySelector('#token').value;

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    const data = {
        contractName: contractName,
        dStatus: dStatus,
       
    }

   if(data.contractName == "" || data.dStatus == ""){
       toastr.error("You need to fill this form please");
   }else{
       

       $.post(addcontraction, data, function (data) {
             if(data.status == 200){
                 let newHtml, html;
                 let hplace = document.getElementById("contract_list");
                  html = '<tr><td>#</td><td>%contract%</td><td>%progress%</td><td>%label%</td></tr>';
                  //newHtml = html.replace('%id%', "new");
                   newHtml = html.replace('%contract%', contractName);
                  newHtml = newHtml.replace('%progress%', "");
                  newHtml = newHtml.replace('%label%', dStatus);
                  hplace.insertAdjacentHTML('afterbegin', newHtml);
                  toastr.success("Contract Successfully Added");
                  document.querySelector('#contractName').value ="";
                  document.querySelector('#dStatus').value="";
                 
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed");
             }
         }); 
        
    }
}