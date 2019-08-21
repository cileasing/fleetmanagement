const btnpostmodule = document.querySelector('#postmodule');
btnpostmodule.addEventListener('click', (e) => moduleSetup(event));

const elements = document.getElementById("pushmoduleForm").elements;
const modroute = $("#modroute").val();
const formID = $("#formID").val();


let postModule = GLOBALS.appRoot + modroute + "/" + formID;

const moduleSetup = (event) => {
     event.preventDefault();
  for (var i = 0, element; element = elements[i++];) {
    if ((element.type === "text" || element.type === "number"  || element.type === "date" || element.type === "email")  && element.value === ""){
          element.style="border:1px solid red";
          toastr.error("You need to fill this form please",  {timeout: 1500});
        }
          
   }
   
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      var dataString = new FormData(document.getElementById('pushmoduleForm'));
      
       $.post(postModule, $('#pushmoduleForm').serialize(), function (data) {
           toastr.info("Capturing Post, Please wait....");
             if(data.status == 200){
                  toastr.success("Item "+data.msg + " Successfully",  {timeout: 150000}); 
                  var list = document.getElementsByTagName('input');
                   /* for(var i = 0; i < list.length; i++) {
                     /* if(list[i].type == 'text' || list[i].type == 'email' || list[i].type == 'number')
                        list[i].value = ''; 
                    } 
                    */
             }else{
                 toastr.error("Please Make Sure all Fields Are Completed",  {timeout: 150000});
             }
         }); 
     
}



