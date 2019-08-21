@extends('layouts.layout')

@section('content')

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asset Details
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Assets</a></li>
        <li class="active">contract</li>
      </ol>
    </section>
 
 
  <!-- Main content -->
    <section class="content">
        <div class="row">
            
            
            <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Name of the Asset</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Asset Details</a></li>
              <li><a href="#tab_2" data-toggle="tab">Asset Utilization </a></li>
              <li><a href="#tab_3" data-toggle="tab">Documentation</a></li>
              <li><a href="#tab_4" data-toggle="tab">Maintenance History</a></li>
              <li><a href="#tab_4" data-toggle="tab">Asset Insurance</a></li>
               <li><a href="#tab_4" data-toggle="tab">Documents</a></li>
              <li><a href="#tab_4" data-toggle="tab">Crew Members</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit Asset</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Send Notification</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Asset Configuration</a></li>
                </ul>
              </li>
              <!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <b>How to use:</b>

                <p>Exactly like the origi
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                The European languages are members of the sa
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing 
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
            
            
          </div>
          <!-- /.box -->



        </div>
            
            
            
            
           
        
        
        
        
            
        </div>
    </section>

<script src="{{ URL::asset('js/global.js') }}"></script>

@endsection