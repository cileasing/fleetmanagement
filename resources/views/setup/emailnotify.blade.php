@extends('layouts.layout')

@section('content')

<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setup Email Notification
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> client</a></li>
        <li class="active">contract</li>
      </ol>
    </section>
 
 
  <!-- Main content -->
    <section class="content">
        <div class="row">
            
            
            <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <!--<h3 class="box-title">Setup Email Content</h3>-->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Asset Notification</a></li>
              <li><a href="#tab_2" data-toggle="tab">Asset Utilization </a></li>
              <li><a href="#tab_3" data-toggle="tab">Documentation</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Dropdown <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Todo Notification</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">ALL Notification</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Help</a></li>
                </ul>
              </li>
              <!--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>-->
            </ul>
            <div class="tab-content">
                
              <div class="tab-pane active" id="tab_1">
                <div class="">
                    <!-- /.box-header -->
                    <div class="box-body pad">
                      <form>
                            <textarea id="editor1" name="editor1" rows="10" cols="80">
                                          {{ $all->value }}
                            </textarea><hr/>
                            <input type="hidden" value="asset_notify" name="asset_notify" id="asset_notify" >
                          <center><button type="submit" id="with_asset_notify" class="btn btn-sm btn-primary">Save</button></center>
                      </form>
                    </div>
                </div>
          <!-- /.box -->
              </div>
                
                
                
                
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="">
                    <!-- /.box-header -->
                    <div class="box-body pad">
                      <form>
                            <textarea id="editor1" name="editor2" rows="10" cols="80">
                                          {{ $doc->value }}
                            </textarea><hr/>
                            <input type="hidden" value="documentation" name="documentation" id="documentation" >
                          <center><button type="submit" class="btn btn-sm btn-primary">Save</button></center>
                      </form>
                    </div>
                </div>
              </div>
              
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="">
                    <div class="box-body pad">
              <form>
                <textarea class="textarea"
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      
                     {{ $util->value }}
                </textarea>
                  <input type="hidden" value="asset_utilize" name="asset_utilize" id="documentation" >
                  <hr/><center><button type="submit" class="btn btn-sm btn-primary">Save</button></center>
              </form>
            </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
            
            
          </div>
          <!-- /.box -->



        </div>
            
            
            
            
            
         <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Notification</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                  <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>ID</th>
                  <th>Notification Name</th>
                  <th style="width: 40px">Content</th>
                </tr>
                  </thead>
                <tbody id="contract_list">
                    
                  
                  <tr>
                    <td>d</td>
                    <td>r</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td>
                      
                    </td>
                 </tr>
                 
               
                </tbody>
                
                
              </table>
            </div>
           
          </div>
          <!-- /.box -->
          
        </div>
        
        
        
        
            
        </div>
    </section>

<script src="{{ URL::asset('js/global.js') }}"></script>
<script src="{{ URL::asset('bower_components/ckeditor/ckeditor.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script src="{{ URL::asset('js/emailcontent.js') }}"></script>
@endsection