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
                            if ($reservation) {
                                foreach ($reservation as $get) {
                                   // $reservatio = $get->reservation_id;
                                    $office = $get->office;
                                    $client_name = $get->client_name;
                                    $contact_name = $get->contact_name;
                                    $contact_email_address = $get->contact_email_address;
                                    $contact_phone_number = $get->contact_phone_number;
                                    $start_date = $get->start_date;
                                    $end_date = $get->end_date;
                                    $po_number = $get->po_number;
                                    $task_status = $get->task_status;
                                    $comment = $get->comment;
                                    $client_type = $get->client_type;
                                    $credit_type = $get->credit_type;
                                    $cost = $get->cost;
                                    $reservation_date = $get->reservation_date;


                                    $matchesOffice = ['office_id' => $office];
                                    $officeName = App\Office::where($matchesOffice)->value('office_name');

                                    $matchesCompany = ['companies_id' => $client_name];
                                    $comp = App\Companies::where($matchesCompany)->value('company_name');

                                    $matchesClient = ['ID' => $contact_name];
                                    $fName = App\Client::where($matchesClient)->value('First_Name');
                                    $LName = App\Client::where($matchesClient)->value('Last_Name');

                                    $clientName = $fName . " " . $LName;
                                }
                            }
                            ?>
                
                <form id="reservationNew" name="reservationNew" class="reservationNew"  action="" method="POST" role="form" enctype="multipart/form-data" onsubmit="return false;">

                    <div class="box-body">
                        
                        <div class="col-sm-12">
                            
                            <h5> <?php echo $breadcrums; ?></h5>

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Trips </a></li>
                                    <li><a href="#tab_3" data-toggle="tab">History</a></li>
                                </ul>
                            </div>


                           
                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_1">

                                    <div class="">
                                        <!-- /.box-header -->
                                        <div class="box-body pad">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Date</label>
                                                    <input disabled value="<?php echo $reservation_date; ?>" type="text" class="form-control datepicker" id="datepicker" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Name</label>
                                                    <input disabled value="<?php echo $comp; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Office</label>
                                                    <input disabled value="<?php echo $officeName; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Type</label>
                                                    <input disabled value="<?php echo $client_type; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Credit Type</label>
                                                    <input disabled value="<?php echo $credit_type; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>




                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Name</label>
                                                    <input disabled value="<?php echo $clientName; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input disabled value="<?php echo $contact_email_address; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Phone</label>
                                                    <input disabled value="<?php echo $contact_phone_number; ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea class="form-control" disabled><?php $comment; ?></textarea>

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status</label>
                                                    <input disabled value="<?php echo $task_status ?>" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>



                                <!--///////////////////////////////////////// BEGINNING OF TAB 2 ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->
                                <div class="tab-pane first_tab tab_second" id="tab_2">

                                    <div class="col-sm-12">
                                        <h6>Added Trips</h6>

                                        <div class="added_main_trips">
                                            <table class="table table-secondary table-responsive table-condensed table-hover table-bordered">
                                                <tr>
                                                    <th>Passenger Name</th>
                                                    <th>Pickup Date</th>
                                                    <th>End Date</th>
                                                    <th>Departure</th>
                                                    <th>Destination</th>
                                                    <th>Vehicle Type</th>
                                                    <th>Service Type</th>
                                                    <th>Total Amount</th>
                                                    <th>Driver</th>
                                                </tr>

                                                <?php
                                                if ($trips) {
                                                    $mainSumTable = 0;
                                                    foreach ($trips as $dTrips) {
                                                        $tID = $dTrips->id;
                                                        $passenger_names = $dTrips->passenger_names;
                                                        $pick_up_date = $dTrips->pick_up_date;
                                                        $pickup_time = $dTrips->pickup_time;
                                                        $end_date = $dTrips->end_date;
                                                        $end_time = $dTrips->end_time;
                                                        $departure = $dTrips->departure;
                                                        $destination = $dTrips->destination;
                                                        $vehicle_id = $dTrips->vehicle_id;
                                                        $vehicle_type = $dTrips->vehicle_type;
                                                         $driver = $dTrips->driver;
                                                        $service_type = $dTrips->service_type;
                                                        $price = $dTrips->price;
                                                        $additional_cost = $dTrips->additional_cost;
                                                        $total_cost = $dTrips->total_cost;

                                                        ////////////////////ADDITIONAL SERVICE IF ANY //////////////
                                                        $trip_service = "SELECT * FROM additional_service_trip WHERE `trip_id` = '$tID'";
                                                        $tripBy_addService = collect(DB::select(DB::raw($trip_service)));

                                                        if ($tripBy_addService) {
                                                            $servicesDesk = "";
                                                            $sum_service = 0;
                                                            foreach ($tripBy_addService as $getA) {
                                                                $service = App\AdditionalService::find($getA->service)->service_name;
                                                                $service_cost = $getA->service_cost;
                                                                $quantity = $getA->quantity;
                                                                $total_cost = $getA->total_cost;

                                                                $sum_service += $total_cost;
                                                                $servicesDesk .= $service . " | " . $total_cost . "<br/>";
                                                            }
                                                        }

                                                        $totalCost = $tripBy_addService != "" ? @number_format($total_cost + $sum_service, 2) : $total_cost;

                                                        $totalCost2 = $tripBy_addService != "" ? $total_cost + $sum_service : $tCost;

                                                        $mainSumTable += $totalCost2;
                                                        
                                                        echo "<tr>
                                                     <td>$passenger_names</td>
                                                     <td>$pick_up_date $pickup_time</td>
                                                    <td>$end_date $end_time</td>
                                                    <td>$departure</td>
                                                    <td>$destination</td>
                                                    <td>$vehicle_type</td>
                                                    <td>$service_type | $total_cost <br/>
                                                        $servicesDesk
                                                      </td>
                                                    <td>$totalCost</td>
                                                    <td>$driver</td>
                                                   </tr>";
                                                    }
                                                }
                                                ?>
                                                 <tr><td colspan='9'>Total Amount : <?php echo @number_format($mainSumTable, 2); ?></td></tr>

                                            </table>
                                        </div>
                                    </div>

                                </div>


                                <!--///////////////////////////////////////// BEGINNING OF TAB 2 ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->
                                <div class="tab-pane first_tab" id="tab_3">

                                    <div class="col-sm-12">&nbsp;</div>

                                </div>



                                <!--///////////////////////////////////////// ADDITIONAL SERVICE ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->


                            </div>


                            </form>
                        </div>
                        <!-- /.box -->



                    </div>




            </div>
            </section>


            <script src="{{ URL::asset('js/global.js') }}"></script>

            <script src="{{ URL::asset('js/reservation.js') }}"></script>


            @endsection
