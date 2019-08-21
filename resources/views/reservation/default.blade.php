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

                <form id="reservationNew" name="reservationNew" class="reservationNew"  action="" method="POST" role="form" enctype="multipart/form-data" onsubmit="return false;">

                    <div class="box-body">

                        <div class="col-sm-12">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Trips </a></li>
                                    <li><a href="#tab_3" data-toggle="tab">Additional Service</a></li>
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
                                                    <input  value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control datepicker" id="datepicker" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Office</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Type</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Credit Type</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>


                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Name</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Name</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Phone</label>
                                                    <input multiple value="" type="text" class="form-control" id="office" name="office" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea class="form-control"></textarea>

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status</label>
                                                    <select class="form-control" id="dStatus" name="dStatus">
                                                        <option value="submitted">submitted</option>
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>



                                <!--///////////////////////////////////////// BEGINNING OF TAB 2 ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->
                                <div class="tab-pane first_tab tab_second" id="tab_2">
                                    <div class="tab_second">

                                        <!-- /.box-header -->
                                        <div class="padd_box_body box-body pad">

                                            <div class="col-sm-12">

                                                  <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Service Type</label>

                                                        <?php
                                                         if($sType){
                                                             $option = "";
                                                             foreach($sType as $sget){
                                                                 $option .= "<option value='$sget->service_id'>$sget->service_type_name</option>";
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

                                                <div class="col-sm-3">
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

                                                <div class="col-sm-3">
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

                                                <div class="col-sm-3">
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

                                                 <div class="col-sm-3">
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

                                                 <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Departure</label>
                                                       <div class="input-group">
                                                        <input type="text" class="form-control" id="depature" name="depature">

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
                                                        <input type="text" class="form-control" id="destination" name="destination">

                                                        <div class="input-group-addon">
                                                          <i class="fa fa-map-signs"></i>
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
                                                        <label for="exampleInputEmail1">Vehicle Type</label>
                                                        <div class="input-group">
                                                        <input type="text" class="form-control" id="vehicle_type" name="vehicle_type">

                                                        <div class="input-group-addon">
                                                          <i class="fa fa-car"></i>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>


                                                 <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">No of Day</label>
                                                        <div class="input-group">
                                                        <input type="text" class="form-control" id="no_of_days" name="no_of_days" class="no_of_days">

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
                                                        <input type="text" class="form-control" id="price_per_day" class="price_per_day">

                                                        <div class="input-group-addon">
                                                          <i class="fa fa-money"></i>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>



                                                <!--<div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"></label>
                                                        <h4>Additional Information <span onclick="myFunction()" class="fa fa-arrow-down" style="font-size:20px"></span></h4>
                                                    </div>
                                                </div>-->

                                                <div class="col-sm-3"><div class="form-group"></div></div>



                                            </div><!-- END OF FIRST SIX COLUMN -->



                                             <div class="col-sm-12">
                                                   <h3>Added Trips</h3>

                                                    <div class="added_main_trips">
                                                        <table class="table table-responsive table-condensed table-hover">
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
                                                        </table>
                                                    </div>
                                             </div>


                                        </div>
                                    </div>
                                </div>


                                 <!--///////////////////////////////////////// BEGINNING OF TAB 2 ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->
                                <div class="tab-pane first_tab" id="tab_3">
                                     <?php
                                                $service = "";
                                                    if($additionalService){
                                                        foreach($additionalService as $serv){
                                                           $service .= "<option value='$serv->id|$serv->unit_price'>$serv->service_name</option>";
                                                        }
                                                    }
                                                ?>

                                            <div id="collapse_table">
                                                <table class="table table-bordered table-responsive table-condensed table-hover"  id="item_table">
                                                    <tr>
                                                        <th>Service Type</th>
                                                        <th>Quantity</th>
                                                        <th>
                                                        <button title="Add More" type="button" name="add" class="btn-sm btn-default add"><span class="fa fa-plus"></span></button>
                                                        <button title="Add More" type="button" name="put" class="btn-sm btn-danger put" id="put"><span class="fa fa-plus"></span></button>

                                                        </th>
                                                    </tr>

                                                     <tr>
                                                         <td>
                                                             <select class="form-control additional_service" id="additional_service" name="additional_service[]">
                                                                 <option value="">select</option>
                                                                <?php echo $service; ?>
                                                             </select>
                                                         </td>

                                                         <td>
                                                              <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Quantity">

                                                         </td>

                                                         <td>
                                                             <button type="type" title="Remove" name="remove" class="btn-danger btn-sm remove"><i class="fa fa-remove"></i></button>
                                                             <!--<button class="btn btn-sm btn-secondary add_new_service" id="add_new_service">Add</button> -->
                                                         </td>
                                                    </tr>


                                                </table>


                                                <div class="col-sm-12">
                                                   <h3>Added Service</h3>

                                                    <div class="add_service_details">
                                                        <table class="table table-responsive table-condensed table-hover">
                                                            <tr>
                                                                <th>Service</th>
                                                                <th>Service Amount</th>
                                                                <th>Total Cost</th>
                                                            </tr>
                                                        </table>
                                                    </div>
                                             </div>


                                        </div>
                                </div>
                                
                                
                                
                             <!--///////////////////////////////////////// ADDITIONAL SERVICE ///////////////////////////////////////////// -->
                                <!-- /.tab-pane -->


                            </div>








                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <button id="add_trips" class="btn btn-danger add_trips">ADD</button>
                                <button  type="submit" id="postmodule" class="btn btn-primary">SAVE</button>
                                 <button  type="submit" id="postmodule" class="btn btn-facebook clearAll">CLEAR</button>

                            </div>
                            </form>
                        </div>
                        <!-- /.box -->



                    </div>




            </div>
            </section>


            <script src="{{ URL::asset('js/global.js') }}"></script>

             <script src="{{ URL::asset('js/reservation.js') }}"></script>

              <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('click', '.add', function () {
                    var html = "";
                    html += "<tr>";

                    html += "<td><select name='additional_service[]' required id='additional_service'  class='form-control additional_service'><option value=''>select</option><?php echo $service; ?></select></td>";
                    html += "<td><input type='text' required name='quantity[]' id='quantity' placeholder='Quantity' class='form-control quantity' /></td>";
                    html += "<td><button type='type' name='remove' class='btn btn-danger btn-sm remove'><i class='fa fa-remove'></i></button></td></tr>";
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



    @endsection
