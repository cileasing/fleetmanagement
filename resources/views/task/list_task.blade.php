@extends('layouts.layout')

@section('content')


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('css/popup.css') }}">

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
               
               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    
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
                    <span class="badge bg-<?php echo  $colors[rand(0, 8)] ?>"><?php echo  $rTotal;; ?></span>
                    <i class="fa {{ $d_icon }}"></i> {{ $vC }}
                    </a>
                   
                   
               
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
      
      
      
    <div class="row">
        <div class="col-xs-12">
          <div class="box" style="padding:10px">
           
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
               
              <table id="example1" class="table table-bordered table-hover">
                   <thead>
                <tr>
			<th>Task No</th>  
                        <th>Reservation Date</th>  
                        <th>Office</th>  
                        <th>Client Name</th> 
                        <th>No of Trips</th>
                        
                        <th>Status</th>
                        <th>Action</th>  
                   
                </tr>
               
                 </thead>
                       
                       <tbody id="contract_list">
                            <?php
                        if($allpendingReservation){
                                        
                            //App\User::find($trans->seller_id)->name
                                
                            foreach($allpendingReservation as $get){
                                $id = $get->reservation_id;
                                
                                $office = $get->office;
                                $client_name = $get->client_name;
                                $contact_name = $get->contact_name;
                                $contact_email_address = $get->contact_email_address;
                                $contact_phone_number = $get->contact_phone_number;
                                $client_type = $get->client_type;
                                $credit_type = $get->credit_type;
                                $task_status = $get->task_status;
                                $reservation_date = $get->reservation_date;
                                
                                //Get number of trips based on reservation
                                 $matches = ['reservation_id' => $id];
                                 $tripCount = App\Trip::where($matches)->get()->count();
                                 
                                 $matchesOffice = ['office_id' => $office];
                                 $officeName = App\Office::where($matchesOffice)->value('office_name');
                                 
                                 $matchesCompany = ['companies_id' => $client_name];
                                 $comp = App\Companies::where($matchesCompany)->value('company_name');
                                 
                                 $matchesClient = ['ID' => $contact_name];
                                 $fName = App\Client::where($matchesClient)->value('First_Name');
                                 $LName = App\Client::where($matchesClient)->value('Last_Name');
                                 
                                 $clientName = $fName." ". $LName;
                      
                        ?>
                           <tr>
                               <td><?php echo $id; ?></td>
                               <td><?php echo $reservation_date; ?></td>
                               <td><?php echo $officeName; ?></td>
                              <td><?php echo $comp; ?></td>
                              <td>
                                    <span class="badge bg-<?php echo  $colors[rand(0, 8)] ?>"><?php echo  $tripCount;; ?></span>
                                 </td>
                              
                            <td><?php echo $task_status; ?></td>
                            <td>
                                <a href="{{ route('reservation.tripdetails', ['id' => $id ]) }}">
                                    <span style="cursor:pointer" class="fa fa-search" title="View"></span>
                                </a>
                                &nbsp;&nbsp;
                                 <a href="{{ route('reservation.edit', ['id' => $id ]) }}">
                                <span style="cursor:pointer" class="fa fa-edit" title="Edit"></span>
                                 </a>
                                <!--<span id="<?php echo $id; ?>" onClick="toggle_visibility('popup-box')" style="cursor:pointer" class="fa fa-picture-o confirmVehicle"></span>-->
                            </td>
                            
                           </tr>   
                           
               <?php
                            }
                        }
              ?>
              </tbody>
                
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
      
      
      
      
         <!-- POP UP BOX HERE -->
                        <div id="popup-box" class="popup-position">
                            <div id="popup-wrapper">
                                <div id="popup-container">
                                    <span class="pull-right"><a href="javascript:void(0)" onClick="toggle_visibility('popup-box');">close</a></span>
                                    <p style="color:red; font-size:12px;">Today <?php echo date("Y-m-d"); ?></p>
                                    <span id="eloaddformerror"></span>
                                    <span id="putoption"></span>
                                </div>
                            </div>
                        </div>
     <!-- END OF POP UP BOX -->
      
     
      
      
    </section>


<script src="{{ URL::asset('js/global.js') }}"></script>
<script src="{{ URL::asset('js/ajax.js') }}"></script>
<script src="{{ URL::asset('js/confirm_vehicle.js') }}"></script>


  <script type="text/javascript" language="javascript">
    $(function () {
          $('#example1').DataTable()
         
    });
        
      </script>    

@endsection