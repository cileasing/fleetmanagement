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
 

<!-- Main content -->
    <section class="content">
        
        <div class="btn-group">
            <!--<a href="{{ route('form.url', ['url' => $url]) }}"><button type="button" class="btn bg-maroon btn-flat margin">Add</button></a>
            <a href=""><button type="button" class="btn bg-purple btn-flat margin">Export</button></a>-->
        <!--     <button type="button" class="btn bg-navy btn-flat margin">.btn.bg-navy.btn-flat</button>
                <button type="button" class="btn bg-orange btn-flat margin">.btn.bg-orange.btn-flat</button>
                <button type="button" class="btn bg-olive btn-flat margin">.btn.bg-olive.btn-flat</button> -->
        </div>
      <!-- /.row -->
      
      
      
      
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Advance Search - Reporting </h3>
               @if($moduleaddButton == '1') 
               <a href="{{ route('form.url', ['url' => $url]) }}"><button type="button" class="btn btn-xs bg-maroon btn-flat margin">Add</button></a>
               @else
                <a href=""></a>
                @endif
                
               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a target="_blank"  href="{{ route('form.edit', ['url' => 'site_modules', 'id' => $module_id] ) }}">Setup</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-left">
                    <!--<strong>Advance Search</strong>-->
                  </p>
                  <div class="advance">
                      <form action="<?php echo $url; ?>" method="GET" name="formGet">
                      <?php
                          $formID = '';
                          $modroute = 'modules/search';
                          if($advsearchitems == '0' || trim($advsearchitems) == ""){
                              echo "";
                          }else{
			  $advsearch_items = explode(',', $advsearchitems);
			  foreach($advsearch_items as $item){
				  echo '<div class="col-sm-3" style="margin-bottom:5px">';
                                  $iitem = explode('-', trim($item));
                                   $fformdata = isset($formdata[$iitem[1]]) && trim(isset($formdata[$iitem[1]])) != '' ? $formdata[$iitem[1]] : '';
				 // echo '<span class="">';
				  //echo '<label for="exampleInputEmail1">'.ucwords(str_replace('_', ' ', $iitem[1])).'</label>';
				  if($iitem[0] == 'on_off'){
                                            if($fformdata == '1'){
                                                $selected = 'selected';
                                            }
                                            elseif($fformdata == '0'){
                                                $selected = 'selected';
                                            }
                                            else $selected = '';
                                           //$selected = ($formdata[$iitem[1]] == ) ? 'selected' : '';
					  echo '<select class="form-control" style="height:35px; font-size:12px" id="'.$iitem[1].'" name="'.$iitem[1].'">';
					  echo '<option '.$selected.' value="">Select '.str_replace("_", " ", $iitem[1]).'</option>';
					  echo '<option '.$selected.' value="1">Active</option>';
					  echo '<option '.$selected.' value="0">In-active</option>';
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
                                             
                                              $categoryitems = App\Modules::where($matchThese)->value('module_table');
                                              $categorypkey = App\Modules::where($matchThese)->value('module_primary_key');
                                              $categoryuitem = App\Modules::where($matchThese)->value('modules_unique_item');
                                              $module_order_by = App\Modules::where($matchThese)->value('module_order_by');
                                              $explodeModule_orderBy = explode(' ',$module_order_by);
        
                                              $categoryName = 'App\\' . $categoryitems;
                                             if(Auth::user()->company_access == '0'){
                                                  $categoryitemsValues = $categoryName::orderBy($categoryuitem, 'asc')->get();
                                              }
                                              else{
                                                  $ciditem = ($iitem[1] == 'cid') ? 'companies_id' : 'cid';
                                                  $usercaccess = Auth::user()->company_access;
                                                  //whereIn($ciditem, array_merge([0], [$usercaccess]))->
                                                  $categoryitemsValues = $categoryName::where(DB::raw($ciditem.' IN (0, '.$usercaccess.') AND del'), '=', '0')->orderBy($categoryuitem, 'asc')->get();
                                                  
                                                  
                                              }
                                              //$categoryitemsValues = $categoryName::orderBy($categoryuitem, 'asc')->get();
                                              
                                               $multiple = $iitem[0] == 'select_multiple' ? 'multiple' : '';
                                               echo '<select class="form-control select2" '.$multiple.' style="width: 100%; height:35px; font-size:12px" id="'.$iitem[1].'" name="'.$iitem[1].'">';
                                               $ilabel = trim($iitem[1]) == 'cid' ? 'Company' : str_replace("_", " ", $iitem[1]);
                                               echo '<option value="">Select '.$ilabel.'</option>';
                                                foreach($categoryitemsValues as $get){
                                                    $iitems3 = (isset($iitem[3]) && trim($iitem[3]) != '' && trim($iitem[3]) != 'disabled') ? trim($iitem[3]) : '';
                                                    $selectvalue = (isset($iitem[3]) && trim($iitem[3]) != '') ? $get->$iitems3 : $get->$categorypkey;
                                                    
                                                    $selected = ($selectvalue == $fformdata) ? 'selected' : '';
                                                     echo '<option '.$selected.' value="'.$selectvalue.'">'.str_replace('_', ' ', $get->$categoryuitem).'</option>';
                                                }
                                                  echo '</select>';
                                            }
                                            else{
                                               echo '<select class="form-control select2" style="width: 100%; height:35px; font-size:12px" id="'.$iitem[1].'" name="'.$iitem[1].'">';
                                               echo '<option value="">Select Option</option>';
                                               echo '</select>';
                                            }
                                            
					 
				  }
				  elseif($iitem[0] == 'date'){
                                         echo '<div class="row">';
					  echo '<div class="col-md-6" style="padding-right:5px"><input  type="text" value="'.$fformdata.'" class="form-control datepicker" style="height:35px; font-size:12px" id="'.$iitem[1].'" name="start_'.$iitem[1].'" placeholder="start '.str_replace('_', ' ', $iitem[1]).'"></div>';
                      echo '<div class="col-md-6" style="padding-left:5px"><input type="text" value="'.$fformdata.'" class="form-control datepicker" style="height:35px; font-size:12px" id="'.$iitem[1].'" name="end_'.$iitem[1].'" placeholder="end '.str_replace('_', ' ', $iitem[1]).'"></div>';
                                            echo '</div>';
                                  } 
				  else echo '<input value="'.$fformdata.'" type="'.$iitem[0].'" class="form-control" style="height:35px; font-size:12px" id="'.$iitem[1].'" name="'.$iitem[1].'" placeholder="'.str_replace('_', ' ', $iitem[1]).'">';
				  
                                  echo '</div>';				  
			  }
			  echo '<input required type="hidden" class="form-control" value="'.$url.'" name="url" id="url" >'
                                  . '<input required type="hidden" class="form-control" value="'.$formID.'" name="formID" id="formID" >'
                                  . '<input required type="hidden" class="form-control" value="'.$modroute.'" name="modroute" id="modroute">';
            }
                
                  if($advsearchitems != '0' && trim($advsearchitems) != ""){         
			  ?>
			  
			  
                       <div class="col-md-2">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      <button  type="submit" id="postmodule" class="btn-success">SEARCH</button>
                    </div>
                    
                    <?php
                  }
                    ?>
                    
                  </form>
                  </div>
                </div>
              
              </div>
              <!-- /.row -->
            </div>
            
           <?php
                $colors = ['green', 'purple', 'yellow', 'teal', 'aqua', 'red', 'blue', 'brown', 'black']
            ?>
            
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
               <div class="box-body">
                    <a class="btn btn-app">
                    <span class="badge bg-<?php echo  $colors[rand(0, 8)] ?>"><?php echo  $countDisplayItemsValues; ?></span>
                    <i class="fa fa-bullhorn"></i> All
                    </a>
                    @if($getallbutton) 
                    @foreach($getallbutton as $getbutton)
                        <a class="btn btn-app" href="{{ strtolower(str_replace(' ', '+', $getbutton->button_url)) }}">
                       
                        <i class="fa fa-{{ $getbutton->button_icon }}"></i> {{ $getbutton->button_name }}
                      </a>
                    @endforeach 
                    @endif 
                    
                    @if($displayHeaderSum) 
                   
                    @foreach($displayHeaderSum as $headerSum) 
                   
                    <a class="btn btn-app" href="{{ $url.'?'.$moduleHeaderSum.'='.strtolower(str_replace(' ', '+', $headerSum->itemName))}}">
                        <span class="badge bg-{{ $colors[rand(0, 8)] }}">{{ $headerSum->sumheader }}</span>
                        <i class="fa fa-bars"></i> {{ $headerSum->itemName }}
                      </a>
                   
                 @endforeach 
                
                 @endif 
                
              <!--   
              <a class="btn btn-app">
                <span class="badge bg-purple">891</span>
                <i class="fa fa-users"></i> Users
              </a>
              <a class="btn btn-app">
                <span class="badge bg-teal">67</span>
                <i class="fa fa-inbox"></i> Orders
              </a>
              <a class="btn btn-app">
                <span class="badge bg-aqua">12</span>
                <i class="fa fa-envelope"></i> Inbox
              </a>
              <a class="btn btn-app">
                <span class="badge bg-red">531</span>
                <i class="fa fa-heart-o"></i> Likes
              </a>
                   
               <a class="btn btn-app">
                <i class="fa fa-edit"></i> Edit
              </a>
              <a class="btn btn-app">
                <i class="fa fa-play"></i> Play
              </a>
              <a class="btn btn-app">
                <i class="fa fa-repeat"></i> Repeat
              </a>
              <a class="btn btn-app">
                <i class="fa fa-pause"></i> Pause
              </a>
              <a class="btn btn-app">
                <i class="fa fa-save"></i> Save
              </a>   
              -->
               
               </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      
      
      
      
      
      
      
    <form name="processPost"  id="processPost" action="{{ route('modules.push', ['url' => $url]) }}" method="POST"/>
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding:10px">
           
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
               
              <table id="example1" class="table table-bordered table-hover">
                   <thead>
                <tr>
			  <?php
			  $idisplayitems = explode(',', $displayitems);
			   echo '<th><input value="'.$url.'" type="checkbox" name="select_all" id="select_all"/> ID</th>';
			  foreach($idisplayitems as $item){
                              $label = (trim($item) == 'cid') ? 'Company' : ucwords(str_replace('_', ' ', $item));
				  echo ' <th>'.$label.'</th>';				  
			  }
                           echo ' <th>Action</th>';
			  ?>               
                   
                </tr>
               
                 </thead>
                        
                       <tbody id="contract_list">
 			  <?php
                       
                       // echo json_encode(  
                         //   SSP::simple( $_GET, $sql_details, $tablesql, $primaryKey, $columns, $cid, $itable, $single , $group )
                          //  );
                         
                      
                          
			  foreach($displayitemsValues as $con){
                              //dd($displayitemsValues);
				echo '<tr>';
				 echo '<td><input class="checkbox" name="postCheck[]" id="postCheck" type="checkbox" value="'.$con->$primaryKey.'"/> '.$con->$primaryKey.'</td>';
					$idisplayitems = explode(',', $displayitems);
                                        //dd($idisplayitems);
					foreach($idisplayitems as $item){
                                             $item = trim($item);
                                            
					  echo ' <td>'.trim($con->$item).'</td>';	  		  
					}
                                        
                                        
                                        echo '<td>';
                                       if($moduleeditButton == '1'){
                                         echo '<a href="'.route('form.edit', ['url' => $url, 'id' => $con->$module_primary_key] ).'"><span style="cursor:pointer" class="fa fa-edit" title="Edit"></span> </a>&nbsp;';  
                                       } 
				echo '<a href="'.route('form.detail', ['url' => $url, 'id' => $con->$module_primary_key]).'"> <span style="cursor:pointer" title="View" class="fa fa-file-picture-o"></span></a>';
				
                                echo '</td>';
                                echo '</tr>';
			  } 
			  ?>               
              <!--</tbody>-->
                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
      
     
             <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="url" id="url" value="{{ $url }}">
             
               <?php
               
                echo ($moduleRecreate == '1') ? '<button id="moduleRecreate" name="moduleRecreate" class="btn btn-sm btn-success">Renew</button>&nbsp;&nbsp;' : '';
                echo ($moduleAppr != '0') ? '<button id="moduleAppr" name="moduleAppr" class="btn btn-sm btn-primary">Verify</button>&nbsp;&nbsp;' : '';
                echo ($moduleUnitappr != '0') ? '<button id="moduleUnitappr" name="moduleUnitappr" class="btn btn-sm btn-warning">Approve</button>&nbsp;&nbsp;' : '';
                echo ($modulePayment != '0') ? '<button id="modulePayment" name="modulePayment" class="btn btn-sm btn-info">Confirm Payment</button>&nbsp;&nbsp;' : '';
                
                ?>
 
      
    </form>
      
      
    </section>


<script src="{{ URL::asset('js/global.js') }}"></script>
<!--<script src="{{ URL::asset('js/search.js') }}"></script>-->

 <script type="text/javascript">

  
  $('form#processPost').submit(function() {
        var c = confirm("Are you sure?");
        return c;
    });

 //select all checkboxes
$("#select_all").change(function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.checkbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

//uncheck "select all", if one of the listed checkbox item is unchecked
$('.checkbox').change(function(){ //".checkbox" change
    if(this.checked == false){ //if this item is unchecked
        $("#select_all")[0].checked = false; //change "select all" checked status to false
    }
});
</script>

  <script type="text/javascript" language="javascript">
    $(function () {
          $('#example1').DataTable()
         
    });
              /*      $(function () {
                     var url = document.querySelector('#url').value;
                    
                    let server_side_model = GLOBALS.appRoot + "index/vessel_data"+ url;
                            load_data();
                            function load_data(data){
                            var dataTable = $('#example2').DataTable({
                                    "processing" : true,
                                    "serverSide" : true,
                                    "order" : [],
                                    "ajax" : {
                                    url: server_side_model,
                                            type : "GET",
                                            data : {data : data}

                                    },
                                    "columnDefs" : [{
                                    "targets" : [2],
                                            "orderable" : false,
                                    }]

                            });
                            }
                    });    
                    */
      </script>    

@endsection