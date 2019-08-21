const pushvesselpost = document.querySelector('#pushvesselpost');
pushvesselpost.addEventListener('click', (e) => addVessels(event));

let postnewasset = GLOBALS.appRoot + "asset/store";

const addVessels = (event) => {
    event.preventDefault();
    
    const assetName = document.querySelector('#assetName').value;
    const vesseType = document.querySelector('#vesseType').value;
    const imoNumber = document.querySelector('#imoNumber').value;
    const owner = document.querySelector('#owner').value;
    const client = document.querySelector('#client').value;
    const grosstonnage = document.querySelector('#grosstonnage').value;
    const TEUcapacity = document.querySelector('#TEUcapacity').value;
    const deadweight = document.querySelector('#deadweight').value;
    const length = document.querySelector('#length').value;
    const beam = document.querySelector('#beam').value;
    const ageofvessel = document.querySelector('#ageofvessel').value;
    const enginepower = document.querySelector('#enginepower').value;
    const built = document.querySelector('#built').value;
    const size = document.querySelector('#size').value;
    const draught = document.querySelector('#draught').value;
    const builder = document.querySelector('#builder').value;
    const placeOfBuild = document.querySelector('#placeOfBuild').value;
    const netTonnage = document.querySelector('#netTonnage').value;
    const crude = document.querySelector('#crude').value;
    const whichContract =  document.querySelector('#whichContract').value;
   
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    const data = {
        assetName: assetName,
        vesseType: vesseType,
        imoNumber: imoNumber,
        owner: owner,
        client: client,
        grosstonnage: grosstonnage,
        TEUcapacity: TEUcapacity,
        deadweight: deadweight,
        length: length,
        beam: beam,
        ageofvessel: ageofvessel,
        enginepower: enginepower,
        built: built,
        size: size,
        draught: draught,
        builder: builder,
        placeOfBuild: placeOfBuild,
        netTonnage: netTonnage,
       crude: crude,
       whichContract:whichContract
    }

   if(data.assetName == "" || data.vesseType == "" || data.imoNumber == "" || data.client == "" || data.owner == ""){
       toastr.error("The Following are require {{ Name, Vessel Type, Client, Owner }} ", {timeOut: 50000});
   }else{
        toastr.info("Adding Vessel please wait }}");
        $('#mainForm').innerHTML = "<br/><img src='https://payhaven.com.ng/payimage/loading.gif' />";
       pushvesselpost.style.visibility = 'hidden'
       $.post(postnewasset, data, function (data) {
             if(data.status == 200){
                 let newHtml, html;
                 let hplace = document.getElementById("contract_list");
                  html = '<tr><td>#</td><td>%assetName%</td><td>%imoNumber%</td><td>%owner%</td><td>%client%</td><td>%action%</td></tr>';
                  //newHtml = html.replace('%id%', "new");
                   newHtml = html.replace('%assetName%', assetName);
                  newHtml = newHtml.replace('%imoNumber%', imoNumber);
                  newHtml = newHtml.replace('%owner%', owner);
                  newHtml = newHtml.replace('%client%', client);
                  newHtml = newHtml.replace('%action%', "<span style='cursor:pointer' class='fa fa-edit' title='Edit'></span> &nbsp; <span style='cursor:pointer' title='View' class='fa fa-file-picture-o'></span>");
                  hplace.insertAdjacentHTML('afterbegin', newHtml);
                  toastr.success("Vessel Successfully Added",  {timeOut: 150000});
                  
                  document.querySelector('#mainForm').innerHTML = '<span class="alert alert-success">Thank you Successfully Added. Page reloads in 5mins</span>';
                  setTimeout(function () { window.location.reload(1); }, 150000);
                 
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed");
             }
         }); 
        
    }
}