<section class="content">
    <div class="row">
       <form action="{{ route('modules.multistore') }}" method="POST" role="form">
           {{ csrf_field() }}
              <div class="box-body" id="settings">
        <table class="table table-bordered" id="item_table">
            <tr>
                <?php
                        $matchTabitem = ['modules_id' => $tab->tab_item];
                        
                       // echo $tab->tab_item;
                        $additems = App\Modules::where($matchTabitem)->value('module_add_items');
			 $iadditems = explode(',', $additems);
			 //  echo '<th><input value="'.$url.'" type="checkbox" name="select_all" id="select_all"/></th>';
			  foreach($iadditems as $item){
			                  $expitem = explode('-', trim($item));
                              $label = ($expitem[1] == 'cid') ? 'Company' : ucwords(str_replace('_', ' ', $expitem[1]));
				  echo ' <th style="background-color:#4b646f; color:white">'.$label.'</th>';				  
			  }
                           //echo ' <th>Action</th>';
                ?>
                
                <th style="width:2%; background-color:#4b646f; color:white"><button title="Add More" type="button" name="add" class="btn btn-success btn-xs add"><span style="font-size: 1em; font-weight:bold" class="glyphicon glyphicon-plus"></span></button></th>
            </tr>
            <tr>
                <?php
                    foreach($iadditems as $item){
                        $expitem = explode('-', trim($item));
                        $default = in_array('estimated_cost', $expitem) || in_array('approved_cost', $expitem) ? '0.00' : '';
                        if($expitem[0] == 'select'){
                            echo '<td>';
                            echo '<select name="'.$expitem[1].'[]" required id="'.$expitem[1].'" placeholder="'.$expitem[1].'" class="form-control selectItem">';
                            echo '<option value="">Select '.$expitem[1].'</option>';
                          //  echo $fillSelect;
                            echo '</select></td>';
                        }
                        elseif($expitem[0] == 'textarea'){
                            echo '<td><textarea name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control exDetailofpayment"></textarea></td>';
                        }
                        elseif($expitem[0] == 'date'){
                            echo '<td><input type="text" required name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="yyyy-mm-dd" class="form-control newdatelog" value="'.date('Y-m-d').'"/></td>';
                        }
                        else{
                            $readonly = in_array('readonly', $expitem) ? 'readonly' : '';
                            echo '<td><input '.$readonly.' type="'.$expitem[0].'" required value="'.$default.'" name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control '.$expitem[1].'" min="0"/></td>';
                        }
                        
                    }
                    echo '<input type="hidden" required name="'.$tab->tab_item_id.'" id="'.$tab->tab_item_id.'"  value="'.$formdata->$mp.'" class="form-control exAmount" min="0"/>';
                     echo '<input type="hidden" required name="url" id="url"  value="'.$url.'" class="form-control url" />';
                    echo '<td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-sm remove">X</button></td></tr>';
                    
                ?>
                
            </tr>
        </table>
          Estimated amount:<input id="amount" type="text" name="amount" value="0.00" class="form-control" readonly style="width:300px; background-color:darkred; color:whitesmoke">
          Approved amount:<input id="appAmount" type="text" name="appAmount" value="0.00" class="form-control" readonly style="width:300px; background-color:darkred; color:whitesmoke">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
             </div>
             </form>
    </div>
</section>


<section class="content">
    <div class="row">
        <?php
           $matchThese = [$tab->tab_item_id => $formdata->$mp];
           $TransactionExist = App\MaintenanceItems::where($matchThese)->get(); // 0
          
           if(isset($TransactionExist) &&  $TransactionExist != ""){
               echo "<table class='table table-responsive table-hover table-striped table-bordered'><tr><th>Type Name</th><th>Sub Type</th><th>Qty</th><th>Estimated Cost</th><th>Estimated Amount</th><th>Approved Cost</th><th>Approved Amount</th><th>Action</th></tr>";
               foreach($TransactionExist  as $get){
                   echo "<tr><td>$get->type_name</td><td>$get->sub_type</td><td>$get->quantity</td><td>$get->estimated_cost</td><td>$get->estimated_amount</td><td>$get->approved_cost</td><td>$get->approved_amount</td><td><i style='curson:pointer' class='btn btn-danger fa fa-edit'></i></td></tr>";
               }
               echo "</table>";
           }
        ?>
    </div>

</section>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('click', '.add', function () {
                   
                    var html = "";
                    var xhtml = "";
                    html += "<tr>";
                     <?php
                     $html = "";
                    foreach($iadditems as $item){
                        $expitem = explode('-', trim($item));
                        $default = in_array('estimated_cost', $expitem) || in_array('approved_cost', $expitem) ? '0.00' : '';
                        if($expitem[0] == 'select'){
                            $html = '<td>';
                            $html .= '<select name="'.$expitem[1].'[]" required id="'.$expitem[1].'" placeholder="'.$expitem[1].'" class="form-control exCode">';
                            $html .= '<option value="">Select '.$expitem[1].'</option>';
                          //  echo $fillSelect;
                            $html .= '</select></td>';
                        }
                        elseif($expitem[0] == 'textarea'){
                            $html .= '<td><textarea name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control exDetailofpayment"></textarea></td>';
                        }
                        elseif($expitem[0] == 'date'){
                            $html .= '<td><input type="text" required name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="yyyy-mm-dd" class="form-control newdatelog" value="'.date('Y-m-d').'"/></td>';
                        }
                        else{
                            $readonly = in_array('readonly', $expitem) ? 'readonly' : '';
                            $html .= '<td><input '.$readonly.' type="'.$expitem[0].'" value="'.$default.'" required name="'.$expitem[1].'[]" id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control '.$expitem[1].'" min="0" value="0.00"/></td>';
                        }
                        
                    }
                    $html .= '<input type="hidden" required name="'.$tab->tab_item_id.'" id="'.$tab->tab_item_id.'" placeholder="'.$tab->tab_item_id.'" value="'.$formdata->$mp.'" class="form-control exAmount" min="0"/>';
                   // $html .= '<td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-sm remove"><i class="material-icons">cancel</i></button></td></tr>';
                    
                ?>
                  
                    xhtml += "<td><button type='type' name='remove' class='btn btn-danger btn-sm remove'>X</button></td></tr>";
                    $('#item_table').append(html + '<?php echo $html; ?>' + xhtml);
                    
                    /* $(".estimated_amount").each(function() {
                        $(this).keyup(function(){
                         calculateSum();
                         });
                    }); */
                    
                    
                });
 
            });
            
            
                $(document).on('click', '.remove', function () {
                    var r = confirm("Are you sure?");
                     if (r == true) {
                    $(this).closest('tr').remove();
                    }
                });
                
        
                
                $("#settings").on("change keyup keydown paste propertychange bind mouseover", function(){
                      calculateOtherSum();
                });
                
                
                function calculateOtherSum() {
                    var sum = 0; 
                    var apsum = 0;
                    $(".estimated_amount").each(function() {
                    if(this.value.length !== "") {
                                            
                    var Qty = $(this).closest("tr").find(".quantity").val();
                    var actPrice = $(this).closest("tr").find(".estimated_cost").val();
                    var subTot = (Qty * actPrice);
                    
                    $(this).val(subTot.toFixed(2));
                    sum += parseFloat(subTot.toFixed(2));
                    
                    var actCost = $(this).closest("tr").find(".approved_cost").val();
                    var appCost = (Qty * actCost);
                    
                    //$(this).val(appCost.toFixed(2));
                    $(this).closest("tr").find(".approved_amount").val(appCost.toFixed(2));
                    apsum += parseFloat(appCost.toFixed(2));
                    
                    }
                    });
                        
                        
                        
                        
                        $('#amount').val(sum.toFixed(2));
                        $('#appAmount').val(apsum.toFixed(2));
                }





               /* $(document).on('click', '.newdatelog', function () {
                    $(this).datepicker({
                        //dateFormat: 'yy-mm-d',
                        format: 'yyyy-mm-dd',
                        weekStart: 1,
                        color: 'red'
                    });
                });
                */
          
                
                
     </script>
     