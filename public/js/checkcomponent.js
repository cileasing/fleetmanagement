$(document).ready(function(){

   $('#fuel_type').change(function(){
   //$("#fuel_type").on("change", function(){
      calculateLitres();
   });
   
    $("#total_amount").on("keyup keydown paste propertychange bind mouseover", function(){
      calculateLitres();
   });
 
 
 function calculateLitres(){
    //var fuelValue = $(this).val();
    var fuelValue = $('#fuel_type').val();
    var token = $('#token').val();
    var quantity_litre = $('#quantity_litre').val();
    var total_amount = $('#total_amount').val();
    var amount = "";
     var action = GLOBALS.appRoot + "getfuel/" + fuelValue;
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    if(fuelValue.length != ""){
          $.post(action, {fuelValue: fuelValue, token: token, quantity_litre:quantity_litre, total_amount: total_amount }, function (responseData) {
          //$.post(action,  $('#pushmoduleForm').serialize(), function (responseData) {
             if(responseData){
                 amount = total_amount / responseData.drate;
                 $('#quantity_litre').val(amount.toFixed(2));
                 toastr.success("Fuel Litre is " + amount.toFixed(2));
                 //alert(amount);
             }
          })
    }else{
        toastr.error("Please Select Fuel Type");
        //alert("please select Fuel Type");
    }
 }
  
});


/*
const getStaffType = (event) => {
    let dtypeValue = document.querySelector('#dType').value;
    
     if(dtypeValue == ""){
        alert("You must select a Type");
        return;
    }else{
        $.post(action, {dtypeValue: dtypeValue}, function (data) {
          if(!data.result){
             document.querySelector('#pickemail').innerHTML = "<input type='text' class='form-controls' name='emailAddress' id='emailAddress' />";
          }else{
              const { result } = data;
              const [ profile ] = result;
              //const name = profile.email;
             outputVar = '<select class="form-controls dType" name="emailAddress" id="emailAddress" data-live-search="true">';
            
            for (var idx = data.result.length - 1; idx >= 0; --idx) {
                outputVar += ' <option value="' + data.result[idx].email + '">' + data.result[idx].fname + '  ' + data.result[idx].lname + '</option>';
               
            }
           
            outputVar += '</select>';
            document.querySelector('#pickemail').innerHTML = outputVar;
          }

       });
        
     } 

}

*/