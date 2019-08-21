<section class="content">
    <div class="row">
        
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
             $modrouteother = isset($id) && $id != "" ? 'modules.edit' : 'modules.store';
             $modroute = isset($id) && $id != "" ? 'modules/edit' : 'modules/store';
             $formID = isset($id) && $id != "" ? $id : '';
            ?>
            <form action="{{ route($modrouteother) }}" method="POST" role="form" enctype="multipart/form-data">
              <div class="box-body">
            <?php
                $matchTabitem = ['modules_id' => $tab->tab_module];
                        
                // echo $tab->tab_item;
                $additems = App\Modules::where($matchTabitem)->value('module_add_items');
			    $iadditems = explode(',', $additems);
			  foreach($iadditems as $item){
			            
                        $expitem = explode('-', trim($item));
                        $fformdata = isset($formdata[$expitem[1]]) && trim(isset($formdata[$expitem[1]])) != '' ? $formdata[$expitem[1]] : '';
                        $disabled = in_array('disabled', $expitem) ? 'disabled' : '';
                        $readonly = in_array('readonly', $expitem) ? 'readonly' : '';
                        $label = ($expitem[1] == 'cid') ? 'Company' : ucwords(str_replace("_", " ", $expitem[1]));
                        echo '<div class="form-group col-md-4"><label for="exampleInputEmail1">'.$label.'</label>';
                        if($expitem[0] == 'select' || $expitem[0] == 'select_multiple'){
                            echo '';
                           // echo '<select name="'.$expitem[1].'" required id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control exCode">';
                            
                        if($iitem[0] == 'on_off'){
                            if($fformdata == '1'){
                                $iselected = 'selected';
                                $oselected = '';
                            }
                            elseif($fformdata == '0'){
                                $oselected = 'selected';
                                $iselected = '';
                            }
                            else {
                                $iselected = '';
                                $oselected = '';
                            }
                           //$selected = ($formdata[$iitem[1]] == ) ? 'selected' : '';
    					  echo '<select '.$disabled.' required class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'">';
    					  echo '<option value="">Select Option</option>';
    					  echo '<option '.$iselected.' value="1">Active</option>';
    					  echo '<option '.$oselected.' value="0">In-active</option>';
    					  echo '</select>';
    				  }
                    elseif(isset($expitem[2]) && trim($expitem[2]) != ''){
                                  $matchThese = ['modules_id' => $expitem[2]];
                                  $iitems4 = (isset($expitem[4]) && trim($expitem[4]) != '') ? trim($expitem[4]) : '';
                                  $iitems5 = (isset($expitem[5]) && trim($expitem[5]) != '') ? trim($expitem[5]) : '';
                                  $categoryitems = App\Modules::where($matchThese)->value('module_table');
                                  $categorypkey = App\Modules::where($matchThese)->value('module_primary_key');
                                  $categoryuitem = App\Modules::where($matchThese)->value('modules_unique_item');
                                  $module_order_by = App\Modules::where($matchThese)->value('module_order_by');
                                  $module_all_items = App\Modules::where($matchThese)->value('all_items');
                                  $explodeModule_orderBy = explode(' ',$module_order_by);
        
                                  $categoryName = 'App\\' . $categoryitems;
                                  $matchlimit = (trim($iitems4) != '' && trim($iitems5) != '') ? [$iitems4 =>  $iitems5] : ['del' =>  '0'];
                                  $categoryitemsValues = $categoryName::where($matchlimit)->orderBy($categoryuitem, 'asc')->get();
                                  
                                   $multiple = $expitem[0] == 'select_multiple' ? 'multiple' : '';
                                   echo '<select '.$disabled.' '.$multiple.' required class="form-control select2" style="width: 100%;" id="'.$expitem[1].'" name="'.$expitem[1].'[]">';
                                   
                                  echo '<option value="">Select '.$label.'</option>';
                                   $noneselected = ($fformdata == '0') ? 'selected' : '';
                                   echo ($module_all_items == '1') ? '<option '.$noneselected.' value="0">None</option>' : '';
                                    foreach($categoryitemsValues as $get){
                                      
                                        $iitems3 = (isset($expitem[3]) && trim($expitem[3]) != '') ? trim($expitem[3]) : '';
                                        $selectvalue = (isset($expitem[3]) && trim($expitem[3]) != '') ? $get->$iitems3 : $get->$categorypkey;
                                        if($iitem[0] == 'select_multiple'){
                                            $selected = in_array($selectvalue, explode(', ', $fformdata)) ? 'selected' : '';
                                        }
                                        else{
                                             $selected = ($selectvalue == $fformdata) ? 'selected' : '';
                                        }
                                         echo '<option '.$selected.' value="'.$selectvalue.'">'.str_replace('_', ' ', $get->$categoryuitem).'</option>';
                                    }
                              echo '</select>';
                            
                        }
                            echo '</select>';
                        }
                        elseif($expitem[0] == 'textarea'){
                            echo '<textarea name="'.$expitem[1].'" '.$disabled.' id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control exDetailofpayment">'.$fformdata.'</textarea>';
                        }
                        elseif($expitem[0] == 'date'){
                            echo '<input type="text" value="'.$fformdata.'" '.$disabled.' required name="'.$expitem[1].'" id="'.$expitem[1].'" placeholder="yyyy-mm-dd" class="form-control newdatelog" value="'.date('Y-m-d').'"/>';
                        }
                        else{
                            $readonly = in_array('readonly', $expitem) ? 'readonly' : '';
                            echo '<input '.$readonly.' type="'.$expitem[0].'" '.$disabled.' value="'.$fformdata.'" required name="'.$expitem[1].'" id="'.$expitem[1].'" placeholder="'.ucwords(str_replace("_", " ", $expitem[1])).'" class="form-control exAmount" min="0"/>';
                        }
                        echo '</div>';
                    }
                     echo '<input required type="hidden" class="form-control" value="'.$url.'" name="url" id="url" >'
                                  . '<input required type="hidden" class="form-control" value="'.$formID.'" name="formID" id="formID" >'
                                  . '<input required type="hidden" class="form-control" value="'.$modroute.'" name="modroute" id="modroute">';
                    echo '<input type="hidden" required name="'.$tab->tab_item_id.'" id="'.$tab->tab_item_id.'" placeholder="'.$tab->tab_item_id.'" value="'.$formdata->$mp.'" class="form-control exAmount" min="0"/>';
                    //echo '<td><button type="type" title="Remove" name="remove" class="btn btn-danger btn-sm remove">X</button>';
                    
                ?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                 <button  type="submit" id="postmodule" class="btn btn-primary">SAVE</button>
                
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>

    </div>
</section>