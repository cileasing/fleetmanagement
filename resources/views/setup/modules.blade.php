@extends('layouts.layout')

@section('content')


 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ ucwords(str_replace('_', ' ', $url)) }}
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> SysManager</a></li>
        <li class="active">{{ ucwords(str_replace('_', ' ', $url)) }}</li>
      </ol>
    </section>
 
 <!-- ADD FORM -->
 
  <!-- Main content -->
    <section class="content">
        <div class="row">
            
            
            <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ ucwords(str_replace('_', ' ', $url)) }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
             $modrouteother = isset($id) && $id != "" ? 'modules.edit' : 'modules.store';
            ?>
            <form id="pushmoduleForm" name="pushmoduleForm"  action="{{ route($modrouteother) }}" method="POST" role="form" enctype="multipart/form-data">
             <!--<form name="pushmoduleForm" id="pushmoduleForm">-->
               <!-- {{ csrf_field() }} -->
              <div class="box-body">
		
			  <?php
			  
			  //$formitem = $formitems->module_add_items;
			  //$iformitems = explode(',', $formitems); '.$formdata[$iitem[1]].'
                          $fformdata = "";
                          $modroute = "";
                          $modroute = isset($id) && $id != "" ? 'modules/edit' : 'modules/store';
                         $formID = isset($id) && $id != "" ? $id : '';
                          
			  foreach($formItems as $item){
                  echo '<div class="col-sm-3" style="margin-bottom:5px">';
				  $iitem = explode('-', trim($item));
				  $disabled = in_array('disabled', $iitem) ? 'disabled' : '';
				  $readonly = in_array('readonly', $iitem) || (isset($_GET[$iitem[1]]) && trim(isset($_GET[$iitem[1]])) != '') ? 'readonly' : '';
				  if(isset($formdata[$iitem[1]]) && trim(isset($formdata[$iitem[1]])) != ''){
				      $fformdata = $formdata[$iitem[1]];
				  }
				  elseif(isset($_GET[$iitem[1]]) && trim(isset($_GET[$iitem[1]])) != ''){
				      $fformdata = $_GET[$iitem[1]];
				  }
				  else{
				      $fformdata =  '';
				  }
                  
				  echo '<div class="form-group">';
				  $label = ($iitem[1] == 'cid') ? 'Company' : ucwords(str_replace('_', ' ', $iitem[1]));
				  echo '<label for="exampleInputEmail1">'.$label.'</label>';
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
					  echo '<select '.$disabled.' '.$readonly.' required class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'">';
					  echo '<option value="">Select Option</option>';
					  echo '<option '.$iselected.' value="1">Active</option>';
					  echo '<option '.$oselected.' value="0">In-active</option>';
					  echo '</select>';
				  }
				  elseif($iitem[0] == 'yes_no'){
                        if($fformdata == '1'){
                            $yselected = 'selected';
                            $nselected = '';
                        }
                        elseif($fformdata == '0'){
                            $nselected = 'selected';
                            $yselected = '';
                        }
                        else {
                            $yselected = '';
                            $nselected = '';
                        }
                       //$selected = ($formdata[$iitem[1]] == ) ? 'selected' : '';
					  echo '<select '.$disabled.' '.$readonly.' required class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'">';
					  echo '<option value="">Select Option</option>';
					  echo '<option '.$yselected.' value="1">Yes</option>';
					  echo '<option '.$nselected.' value="0">No</option>';
					  echo '</select>';
				  }
                    elseif($iitem[0] == 'select' || $iitem[0] == 'select_multiple'){
                        if($fformdata == '1'){
                            $selected = 'selected';
                        }
                        else $selected = '';
                       //$selected = ($formdata[$iitem[1]] == ) ? 'selected' : '';
                        if(isset($iitem[2]) && trim($iitem[2]) != ''){
                          $matchThese = ['modules_id' => $iitem[2]];
                          $iitems4 = (isset($iitem[4]) && trim($iitem[4]) != '') ? trim($iitem[4]) : '';
                          $iitems5 = (isset($iitem[5]) && trim($iitem[5]) != '') ? trim($iitem[5]) : '';
                          $categoryitems = App\Modules::where($matchThese)->value('module_table');
                          $categorypkey = App\Modules::where($matchThese)->value('module_primary_key');
                          $categoryuitem = App\Modules::where($matchThese)->value('modules_unique_item');
                          $module_order_by = App\Modules::where($matchThese)->value('module_order_by');
                          $module_all_items = App\Modules::where($matchThese)->value('all_items');
                          $explodeModule_orderBy = explode(' ',$module_order_by);

                          $categoryName = 'App\\' . $categoryitems;
                          $matchlimit = (trim($iitems4) != '' && trim($iitems5) != '') ? [$iitems4 =>  $iitems5] : ['del' =>  '0'];
                          
                          if(isset($_GET[$iitem[1]]) && trim(isset($_GET[$iitem[1]])) != ''){
                              $matchgetval = [$categoryuitem => str_replace('%20', ' ', $_GET[$iitem[1]])];
                              $getitemValue = $categoryName::where($matchgetval)->value($categorypkey);
                              $categoryitemsValues = $categoryName::where($matchgetval)->orderBy($categoryuitem, 'asc')->get();
                          }
                          elseif(Auth::user()->company_access == '0'){
                              $categoryitemsValues = $categoryName::where($matchlimit)->orderBy($categoryuitem, 'asc')->get();
                          }
                          else{
                              $ciditem = ($iitem[1] == 'cid') ? 'companies_id' : 'cid';
                              $usercaccess = Auth::user()->company_access;
                              //whereIn($ciditem, array_merge([0], [$usercaccess]))->
                              $categoryitemsValues = $categoryName::where($matchlimit)->where(DB::raw($ciditem.' IN (0, '.$usercaccess.') AND del'), '=', '0')->orderBy($categoryuitem, 'asc')->get();
                              
                          }
                          //$categoryitemsValues = $categoryName::where($matchlimit)->orderBy($categoryuitem, 'asc')->get();
                          
                           $multiple = $iitem[0] == 'select_multiple' ? 'multiple' : '';
                           echo '<select '.$disabled.' '.$multiple.' '.$readonly.' required class="form-control select2" style="width: 100%;" id="'.$iitem[1].'" name="'.$iitem[1].'[]">';
                           
                           echo '<option value="">Select Option</option>';
                           $noneselected = ($fformdata == '0') ? 'selected' : '';
                           echo ($module_all_items == '1') ? '<option '.$noneselected.' value="0">None</option>' : '';
                            foreach($categoryitemsValues as $get){
                              
                                $iitems3 = (isset($iitem[3]) && trim($iitem[3]) != '') ? trim($iitem[3]) : '';
                                $selectvalue = (isset($iitem[3]) && trim($iitem[3]) != '') ? $get->$iitems3 : $get->$categorypkey;
                                
                                if($iitem[0] == 'select_multiple'){
                                    $selected = in_array($selectvalue, explode(', ', $fformdata)) ? 'selected' : '';
                                }
                                elseif($selectvalue == $fformdata || ((isset($_GET[$iitem[1]]) && trim(isset($_GET[$iitem[1]])) != '') && $selectvalue == $getitemValue)){
                                        $selected = 'selected';
                                }
                                else $selected = '';
                        
                               
                               
                               /* $iitems4 = (isset($iitem[4]) && trim($iitem[4]) != '') ? trim($iitem[4]) : '';
                                $selectvaluefour = (isset($iitem[4]) && trim($iitem[4]) != '') ? $get->$iitems4 : $get->$categorypkey;
                                $selectedfour = ($selectvaluefour == $fformdata) ? 'selected' : '';
                                *
                                */
                                 echo '<option '.$selected.' value="'.$selectvalue.'">'.str_replace('_', ' ', $get->$categoryuitem).'</option>';
                              /*  if($selectvaluefour){
                                    echo '<option '.$selectedfour.' value="'.$selectvaluefour.'">'.$get->$categoryuitem.'</option>';
                                }else{
                                 echo '<option '.$selected.' value="'.$selectvalue.'">'.$get->$categoryuitem.'</option>';
                                } */
                            }
                              echo '</select>';
                            
                        }
                        else{
                           echo '<select required class="form-control select2" style="width: 100%;" id="'.$iitem[1].'" name="'.$iitem[1].'">';
                           echo '<option value="">Select Option</option>';
                           echo '</select>';
                        }
				  }
				  elseif($iitem[0] == 'textarea'){
					  echo '<textarea '.$disabled.' '.$readonly.' required style="height:120px" type="'.$iitem[0].'" class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'"> '.$fformdata.'</textarea>';
				  }
				  elseif($iitem[0] == 'datetime'){
                            echo '<input type="datetime-local" value="'.$fformdata.'" '.$disabled.' required name="'.$iitem[1].'" id="'.$iitem[1].'" placeholder="yyyy-mm-dd" class="form-control"/>';
                  }
                  elseif($iitem[0] == 'date'){
					  echo '<input '.$disabled.' '.$readonly.' required type="text" value="'.$fformdata.'" class="form-control datepicker" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'">';
				  } 
				  elseif($iitem[0] == 'file'){
				      echo '<input '.$disabled.' '.$readonly.' multiple value="'.$fformdata.'" type="'.$iitem[0].'" class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'">';
				  
				  }
				  elseif($iitem[0] == 'text' && isset($iitem[2]) && trim($iitem[2]) != 'disabled'){
				      //text-type-financier
				      $defaultvalue = isset($iitem[2]) && trim($iitem[2]) != '' && trim($iitem[2]) != 'disabled' ? trim($iitem[2]) : '';
				      echo '<input '.$disabled.' readonly value="'.$defaultvalue.'" required type="'.$iitem[0].'" class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'">';
				  
				  }
				  else echo '<input '.$disabled.' '.$readonly.' value="'.$fformdata.'" required type="'.$iitem[0].'" class="form-control" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'">';
				  
				  echo '</div>';
                                  echo '</div>';
			  }
			  echo '<input required type="hidden" class="form-control" value="'.$url.'" name="url" id="url" >'
                                  . '<input required type="hidden" class="form-control" value="'.$formID.'" name="formID" id="formID" >'
                                  . '<input required type="hidden" class="form-control" value="'.$modroute.'" name="modroute" id="modroute">';
                         
			  ?>               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <button  type="submit" id="postmodule" class="btn btn-primary">SAVE</button>
                <?php
                    if($formID && $copyButton == '1'){
                        echo  '&nbsp;&nbsp;<input  type="submit" id="copyitem" name="copyitem" class="btn btn-danger" value="COPY" />';
                    }
                ?>
                
              </div>
            </form>
          </div>
          <!-- /.box -->



        </div>
            
            
        
            
        </div>
    </section>
 <script type="text/javascript">
  $('form#pushmoduleForm').submit(function() {
        var c = confirm("Are you sure?");
        return c;
    });
 </script> 
<script src="{{ URL::asset('js/global.js') }}"></script>
<?php echo isset($javascript) ? $javascript : ""; ?>
<!--<script src="{{ URL::asset('js/modulesetup.js') }}"></script>-->



@endsection