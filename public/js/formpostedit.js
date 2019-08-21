const pushvesselpost = document.querySelector('#pushvesselpostEdit');
pushvesselpost.addEventListener('click', (e) => addVessels(event));

const assetID = document.querySelector('#assetID').value;

let postnewasset = GLOBALS.appRoot + "asset/update/" + assetID;

const addVessels = (event) => {
    event.preventDefault();
    
    const assetID = document.querySelector('#assetID').value;
    const slug = document.querySelector('#slug').value;
    
    const assetName = document.querySelector('#assetName').value;
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
        assetID: assetID,
        slug: slug,
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

   if(data.assetName == "" ){
       toastr.error("The Following are require {{ Name }} ", {timeOut: 50000});
   }else{
        toastr.info("Updating Asset, please wait...");
        $('#mainForm').innerHTML = "<br/><img src='https://payhaven.com.ng/payimage/loading.gif' />";
       pushvesselpost.style.visibility = 'hidden'
       $.post(postnewasset, data, function (data) {
             if(data.status == 200){
                 
                  toastr.success("Successfully Updated",  {timeOut: 150000});
                  
                  document.querySelector('#mainForm').innerHTML = '<span class="alert alert-success">Thank you Successfully Added. Page reloads in 5mins</span>';
                   setTimeout(function(){window.top.location= GLOBALS.appRoot + "asset"} , 5000);
                 
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed");
             }
         }); 
        
    }
}

const goback = () => {
    window.history.go(-1);
}