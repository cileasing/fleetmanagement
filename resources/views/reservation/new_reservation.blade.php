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
                                                    <input readonly value="<?php echo date('Y-m-d'); ?>" type="text" class="form-control datepicker" id="datepicker" name="datepicker" placeholder="">

                                                </div>
                                            </div>

                                             <?php
                                                    if ($office) {
                                                        $option = "";
                                                        foreach ($office as $sget) {
                                                            $option .= "<option value='$sget->office_id'>$sget->office_name</option>";
                                                        }
                                                    }
                                             ?>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Office</label>
                                                     <select class="form-control" id="office" name="office" >
                                                            <option value="">Select</option>
                                                            <?php echo $option; ?>
                                                        </select>
                                                   
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Type</label>
                                                     <select class="form-control" id="client_type" name="client_type" >
                                                            <option value="">Select</option>
                                                            <option value="individual">Individual</option>
                                                            <option value="company">Company</option>
                                                        </select>

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Credit Type</label>
                                                    <select class="form-control" id="credit_type" name="credit_type" >
                                                            <option value="">Select</option>
                                                            <option value="credit">Credit Client</option>
                                                            <option value="non-credit">Non Credit Client</option>
                                                        </select>

                                                </div>
                                            </div>

                                            
                                            <?php
                                                    if ($comp) {
                                                        $option_comp = "";
                                                        foreach ($comp as $sget) {
                                                            $option_comp .= "<option value='$sget->companies_id'>$sget->company_name</option>";
                                                        }
                                                    }
                                             ?>
                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Client Name</label>
                                                     <select class="form-control" id="client_name" name="client_name">
                                                            <option value="">Select</option>
                                                            <?php echo $option_comp; ?>
                                                        </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Name</label>
                                                    <select class="form-control mySelect" id="contact_name" name="contact_name">
                                                            <option value="">Select</option>
                                                            <!--<div id="pickemail"></div>-->
                                                    </select>
                                                  
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input multiple value="" type="text" class="form-control" id="contact_email" name="contact_email" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Phone</label>
                                                    <input multiple value="" type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="">

                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Comment</label>
                                                    <textarea class="form-control" name="comment" id="comment"></textarea>

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




                            </div>



                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <button  type="submit" id="save_reservation" class="btn btn-primary">SAVE</button>

                            </div>
                            </form>
                        </div>
                        <!-- /.box -->



                    </div>




            </div>
            </section>


            <script src="{{ URL::asset('js/global.js') }}"></script>
            <script src="{{ URL::asset('js/details.js') }}"></script>
            <script src="{{ URL::asset('js/client_drop.js') }}"></script>



    @endsection
