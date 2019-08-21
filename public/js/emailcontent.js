
const btnwith_asset_notify = document.querySelector('#with_asset_notify');
btnwith_asset_notify.addEventListener('click', (e) => addnotifycontent(event));

const asset_notify = document.querySelector('#asset_notify').value;
let addassetnotification = GLOBALS.appRoot + "email/store/" + asset_notify;




const addnotifycontent = (event) => {
    event.preventDefault();
   // const editor1 = document.querySelector('#editor1').value;
    const editor = CKEDITOR.instances["editor1"].getData();
    const asset_notify = document.querySelector('#asset_notify').value;
    //const token = document.querySelector('#token').value;
    

    //var editor = CKEDITOR.instances["editor1"].getData();
   alert( 'Total bytes: ' + editor);
    return;
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      

    const data = {
        editor1: editor1,
        asset_notify: asset_notify,
       
    }

   if(data.asset_notify == "" || data.editor1 == ""){
       toastr.error("You need to addd a notification message");
   }else{
       

       $.post(addassetnotification, data, function (data) {
             if(data.status == 200){
                  toastr.success("Message Successfully Added");
                 
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed");
             }
         }); 
        
    }
}