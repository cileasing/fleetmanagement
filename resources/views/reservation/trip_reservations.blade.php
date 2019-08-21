@extends('layouts.layout')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ ucwords(str_replace('_', ' ', 'New Trip')) }}
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> SysManager</a></li>
        <li class="active">{{ ucwords(str_replace('_', ' ', 'New Trip')) }}</li>
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
                    <h3 class="box-title">{{ ucwords(str_replace('_', ' ', 'CLIENT NAME:  ')) }}
                        <b><?php echo strtoupper($comp_full_name); ?></b></h3>
                     <div class="cost" style="font-size: 13px" ></div>
                    
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form id="trip_information" name="trip_information" class="trip_information"  action="" method="POST" role="form" enctype="multipart/form-data" onsubmit="return false;">

                    <div class="box-body">

                        <div class="col-sm-12">

                            <div class="content">         
                                <div class="stepwizard">
                                    <div class="stepwizard-row setup-panel">

                                        <div class="stepwizard-step">
                                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                            <h5>Passenger's Details <span class="fa fa-users"></span></h5>

                                        </div>

                                        <div class="stepwizard-step">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                            <h5>Trip Details <span class="fa fa-car"></span></h5>
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                            <h5>Additional Services <span class="fa fa-plus"></span></h5>

                                        </div>



                                    </div>
                                </div>



                                <div class="regular-search">

                                    <div class="setup-content" id="step-1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr/>
                                                
        <!-- ///////////////////////////////////////////////// ALL HIDDEN FIELDS //////////////////////////////////-->
                            
                         <input type="hidden" id="pushPrice" class="pushPrice" name="pushPrice"/>
                         <input type="hidden" id="number_of_days" class="number_of_days" name="number_of_days"/>
                         <input type="hidden" id="price_per_day" class="price_per_day" name="price_per_day"/>
                          <input type="hidden" id="total_cost" class="total_cost" name="total_cost"/>
                           <input type="hidden" value="<?php echo @$cl_name; ?>" id="client_id" class="client_id" name="client_id"/>
                    
                   
        <!-- ///////////////////////////////////////////////// ALL HIDDEN FIELDS //////////////////////////////////-->
           
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Service Type</label>

                                                        <?php
                                                        if ($sType) {
                                                            $option = "";
                                                            foreach ($sType as $sget) {
                                                                $option .= "<option value='$sget->reservation_name'>$sget->service_type_name</option>";
                                                            }
                                                        }
                                                        ?>

                                                        <div class="input-group">
                                                            <select class="form-control" name="service_type" id="service_type">
                                                                <option value="">Select</option>
                                                                <?php echo $option; ?>
                                                            </select>
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-arrow-down"></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Passenger's Name</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="passengerName" name="passengerName">

                                                            <div class="input-group-addon">
                                                                <i class="fa fa-navicon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">No of Passengers</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="nof_passenger" name="nof_passenger">

                                                            <div class="input-group-addon">
                                                                <i class="fa fa-users"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Passenger's Email</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="passengers_email" name="passengers_email">

                                                            <div class="input-group-addon">
                                                                <i class="fa fa-mail-forward"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Passenger's Phone</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="passengers_phone" name="passengers_phone">

                                                            <div class="input-group-addon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">&nbsp;</label>
                                                        <div class="input-group">
                                                           <center><button class="button nextBtn btn-sm newbtncl btn btn-primary" type="button" >Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 


                                            </div>
                                        </div>
                                    </div>

                                    
                                    
    
 <!--/////////////////////////////////////////////BEGINNING OF STEP 2  //////////////////////////////////-->                                   
                        <hr/>           
                         <div class="setup-content" id="step-2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                 <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Departure</label>
                                                    <?php
                                                    if ($dStates) {
                                                        $optionL = "";
                                                        foreach ($dStates as $sget) {
                                                            $optionL .= "<option value='$sget->location_name'>$sget->location_name</option>";
                                                        }
                                                    }
                                                    ?>

                                                    <div class="input-group">
                                                        <select class="form-control"  id="depature" name="depature">
                                                            <option value="">Select</option>
                                                            <?php echo $optionL; ?>
                                                        </select>

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-map"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Destination</label>

                                                    <div class="input-group">
                                                        <select class="form-control"  id="destination" name="destination">
                                                            <option value="">Select</option>
                                                            <?php echo $optionL; ?>
                                                        </select>

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-map-signs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                           <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Vehicle Category</label>
                                                    <div class="input-group">

                                                        <?php
                                                        if ($vCat) {
                                                            $optionV = "";
                                                            foreach ($vCat as $sget) {
                                                                $optionV .= "<option value='$sget->vehicle_type'>$sget->vehicle_type</option>";
                                                            }
                                                        }
                                                        ?>
                                                        <select class="form-control"  id="vehicle_type" name="vehicle_type">
                                                            <option value="">Select</option>
                                                            <?php echo $optionV; ?>
                                                        </select>

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-car"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                 <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Pick up Date</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker" id="pick_up_date"  name="pick_up_date">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar-plus-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Pick up Time</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control timepicker" id="pick_up_time"  name="pick_up_time">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                                
                                                
                                         
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End Date</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control datepicker" id="end_date" name="end_date">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar-plus-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">End Date Time</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control timepicker" id="end_date_time" name="end_date_time">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                           
                                                
                                                
                                                 <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Drop Off Location</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="actual_street" name="actual_street">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-map"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Additional Cost</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="additional_cost" name="additional_cost">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-clock-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                                 <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">&nbsp;</label>
                                                        <div class="input-group">
                                                           <center><button class="button nextBtn btn-sm newbtncl btn btn-primary" type="button" >Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

 <!--/////////////////////////////////////////////END OF STEP 2  //////////////////////////////////--> 
 
 
 
                                  <div class="setup-content" id="step-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                    <?php
                                                $service_dropdown = "";
                                                if ($additionalService) {
                                                    foreach ($additionalService as $serv) {
                                                        //$service .= "<option value='$serv->id|$serv->unit_price'>$serv->service_name</option>";
                                                        $service_dropdown .= "<option value='$serv->id'>$serv->service_name</option>";
                                                    }
                                                }
                                                ?>
                                                
                                                <table class="table table-bordered table-responsive table-condensed table-hover"  id="item_table">
                                                        <tr>
                                                            <th>Service Type</th>
                                                            <th>Quantity</th>
                                                             <th>Cost</th>
                                                            <th>
                                                            <!--<button title="Add More" type="button" name="add" class="btn-sm btn-default add"><span class="fa fa-plus"></span></button>-->
                                                                <button title="Add More" type="button" name="add" class="btn-xs btn-danger add" id="add"><span class="fa fa-plus"></span></button>

                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <select class="form-control additional_service" id="additional_service" name="additional_service[]">
                                                                    <option value="">select</option>
                                                                    <?php echo $service_dropdown; ?>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity">

                                                            </td>
                                                            
                                                            <td>
                                                                <input type="text" class="form-control add_cost" id="add_cost" name="add_cost[]" placeholder="Cost">

                                                            </td>

                                                            <td>
                                                                <button type="type" title="Remove" name="remove" class="btn-danger btn-xs remove"><i class="fa fa-remove"></i></button>
                                                                <!--<button class="btn btn-sm btn-secondary add_new_service" id="add_new_service">Add</button> -->
                                                            </td>
                                                        </tr>


                                                    </table>
                                   
                                              <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $rId; ?> }}">
                                <button  type="submit" id="add_trips" class="btn btn-primary">ADD</button> &nbsp;&nbsp;
                                <button  type="submit" id="add_trips" class="btn btn-danger pull-right">FINISH</button>

                            </div>
                                             <!-- <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No of Day</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="no_of_days" name="no_of_days" class="no_of_days">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-dashcube"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Price Per Day</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="price_per_day" name="price_per_day" class="price_per_day">

                                                        <div class="input-group-addon">
                                                            <i class="fa fa-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>                                     





                          

                            <div class="col-sm-12">
                                <h3>Added Trips</h3>

                                

                                <table style="font-size:13px" class="table table-responsive table-bordered table-condensed table-hover">
                                    <tr>
                                        <th>ID</th>
                                        <th>Passenger Name</th>
                                        <th>Pickup Date</th>
                                        <th>End Date</th>
                                        <th>Departure</th>
                                        <th>Destination</th>
                                        <th>Vehicle Type</th>
                                        <th>Service Type</th>
                                        <th>Total Amount</th>
                                        <th>Driver</th>
                                        <th>Action</th>
                                    </tr>

                                    <tbody id="contract_list">

                                        <?php
                                        ?>

                                        <?php
                                        if ($tripDetails) {
                                            $mainSumTable = 0;

                                            foreach ($tripDetails as $con) {

                                                $tID = $con->id;
                                                $noDays = $con->number_of_days;
                                                $priceDay = $con->price_per_day;
                                                $reservation_id = $con->reservation_id;
                                                $tCost = $con->total_cost;

                                                //$addServiceTrip = AdditionalServiceTrip::where('trip_id', $tID)->get();
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

                                                $totalCost = $tripBy_addService != "" ? @number_format($con->total_cost + $sum_service, 2) : $tCost;

                                                $totalCost2 = $tripBy_addService != "" ? $con->total_cost + $sum_service : $tCost;

                                                $mainSumTable += $totalCost2;
                                                echo "<tr>
                                                    <td>$con->id</td>
                                                     <td>$con->passenger_names</td>
                                                     <td>$con->pick_up_date</td>
                                                    <td>$con->end_date</td>
                                                    <td>$con->departure</td>
                                                    <td>$con->destination</td>
                                                    <td>$con->vehicle_type</td>
                                                    <td>$con->service_type | $tCost <br/>
                                                        $servicesDesk
                                                      </td>
                                                    <td>$totalCost</td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                    
                                                    <span class='fa fa-edit' style='cursor:pointer'></span>&nbsp;&nbsp;&nbsp;
                                                    <span class='fa fa-remove' style='cursor:pointer'></span>&nbsp;&nbsp;&nbsp;
                                                     <span class='fa fa fa-image' style='cursor:pointer'></span>
                                                    
                                                    </td>
                                                     </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No Trip</td></tr>";
                                        }
                                        ?>
                                        <tr><td colspan='12'>Total Amount : <?php echo @number_format($mainSumTable, 2); ?></td></tr>

                                    </tbody>
                                </table>

                            </div>
                            </form>
                        </div>
                        <!-- /.box -->



                    </div>




            </div>
            </section>


            <script src="{{ URL::asset('js/global.js') }}"></script>
            <script src="{{ URL::asset('js/trips.js') }}"></script>
            <script src="{{ URL::asset('js/twowaybinding.js') }}"></script>
            <script src="{{ URL::asset('js/formstep.js') }}"></script>



            <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $(document).on('click', '.add', function () {
                                                            var html = "";
                                                            html += "<tr>";

                                                            html += "<td><select name='additional_service[]' required id='additional_service'  class='form-control additional_service'><option value=''>select</option><?php echo $service_dropdown; ?></select></td>";
                                                            html += "<td><input type='text' required name='quantity[]' id='quantity' placeholder='Quantity' class='form-control quantity' /></td>";
                                                            html += "<td><input type='text' required name='add_cost[]' id='add_cost' placeholder='Cost' class='form-control add_cost' /></td>";
                                                            html += "<td><button type='type' name='remove' class='btn btn-danger btn-xs remove'><i class='fa fa-remove'></i></button></td></tr>";
                                                            $('#item_table').append(html);
                                                        });


                                                        $(document).on('click', '.remove', function () {
                                                            var r = confirm("Please make sure this particular row you want to remove all details, eg. Payment details, amount, select code and date is empty before your remove");
                                                            if (r == true) {
                                                                $(this).closest('tr').remove();
                                                            }
                                                        });

                                                        $(document).on('click', '.newdatelog', function () {
                                                            $(this).datepicker({
                                                                //dateFormat: 'yy-mm-d',
                                                                format: 'yyyy-mm-dd',
                                                                weekStart: 1,
                                                                color: 'red'
                                                            });
                                                        });



                                                    });
            </script>

            <script type="text/javascript">
                function toggleContent() {
                    // Get the DOM reference
                    var contentId = document.getElementById("collapse_table");
                    // Toggle 
                    contentId.style.display == "block" ? contentId.style.display = "none" :
                            contentId.style.display = "block";
                }
            </script>


            @endsection
