<section class="content">
    <div class="row">

       
        <table class="table table-responsive">
            
            <tr>
                <?php
                        $matchTabitem = ['modules_id' => $tab->tab_item];
                        
                       // echo $tab->tab_item;
                        $displayitems = App\Modules::where($matchTabitem)->value('module_display_items');
			 $idisplayitems = explode(',', $displayitems);
			   echo '<th><input value="'.$url.'" type="checkbox" name="select_all" id="select_all"/></th>';
			  foreach($idisplayitems as $item){
                              $label = ($item == 'cid') ? 'Company' : ucwords(str_replace('_', ' ', $item));
				  echo ' <th>'.$label.'</th>';				  
			  }
                           //echo ' <th>Action</th>';
                ?>
            </tr>
            <tbody>
              
               <?php
                $matchTableitemID = [$tab->tab_item_id => $id];
                $ModuleTable = App\Modules::where($matchTabitem)->value('module_table');
                $primaryKey = App\Modules::where($matchTabitem)->value('module_primary_key');
                $displayName = 'App\\' . $ModuleTable;
                $getdisplaydetails = $displayName::where($matchTableitemID)->get();
                
            foreach($getdisplaydetails as $con){
                              //dd($displayitemsValues);
				echo '<tr>';
				 echo '<td><input class="checkbox" name="postCheck[]" id="postCheck" type="checkbox" value="'.$con->$primaryKey.'"/></td>';
					$idisplayitems = explode(',', $displayitems);
                                        //dd($idisplayitems);
					foreach($idisplayitems as $item){
                                             $item = trim($item);
                                            
					  echo ' <td>'.trim($con->$item).'</td>';	  		  
					}
                                        
                                        
                                        echo '<td>';
                                       
				
                                echo '</td>';
                                echo '</tr>';
			  } 
              
           
           ?>
            </tbody>
            
        </table>

    </div>
</section>