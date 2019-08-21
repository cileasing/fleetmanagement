<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <?php
    $url = isset($url) ? $url :  'Dashboard';
  ?>
  <title>{{ strtoupper(str_replace('_', ' ', $url)) }} | SYSTEM MANAGER </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  
   <!-- DataTables -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
  
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/select2/dist/css/select2.min.css') }}">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ URL::asset('dist/css/skins/_all-skins.css') }}">

  <link href="{{ URL::asset('toastr/toastr.min.css') }}" type="text/css" rel="stylesheet"/>
  
   <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
 
  
  <!-- jQuery 3 -->
<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


    <!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.3/css/autoFill.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.5.1/css/colReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/keytable/2.5.0/css/keyTable.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.0/css/scroller.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
  
     
<style type="text/css">
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .has-error{
        border:1px solid red;
    }
</style>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>ys</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sys</b>Manager</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <!--<li class="header">You have 4 messages</li>
              <li>
               
                <ul class="menu">
                  
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{ URL::asset('dist/img/user4-128x128.jpg') }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>-->
            </ul>
          </li>
          
          
          
          
          
          <!-- Notifications: style can be found in dropdown.less
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <!--<li class="header">You have 10 notifications</li>
              <li>
               
                <ul class="menu">
                 
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          
          
          
          
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             <!-- <img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">-->
             <span class="hidden-xs"> {{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               <!-- <img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">-->

                <p>
                   {{ Auth::user()->name }}
                  <small> {{ Auth::user()->email }}</small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/form/edit/admin_user_profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                   <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                          Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header
  
  
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!--<img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">-->
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="http://{{ $_SERVER['SERVER_NAME'] }}">
            <i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span>
          </a>
          
        </li>
        
       
         
        <?php
           // use App\Category;
            
         
           $getall = App\Category::WHERE(DB::raw('category_id IN ('.Auth::user()->category_access.') AND del'), '=', '0')->orderBy('category_name', 'asc')->get();
           
           // $colornum = 0;
            $colors = ['aqua', 'red', 'blue', 'green', 'orange', 'danger', 'fuchsia', 'success', 'black'];
           // $mcolornum = 0;
            
           foreach($getall as $get){
               echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-'.$get->category_icon.' text-'.$colors[rand(0, 8)].'"></i>
            <span>'.$get->category_name.'</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            $matchsub = ['module_category' => $get->category_id];
            $subitems = App\Modules::where($matchsub)->WHERE(DB::raw('module_user IN (0, '.Auth::user()->user_type.') AND module_status'), '=', '1')->orderBy('module_title', 'asc')->get();
            $routelink = App\Modules::where($matchsub)->WHERE('module_status', '=', '1')->orderBy('module_route', 'asc')->get();
           
            foreach($subitems as $sub){    
                $urlroute = 'http://localhost:8081/'.$sub->module_route.'/'.$sub->module_url;
            echo '<li><a href="'.$urlroute.'"><i class="fa fa-circle-o text-'.$colors[rand(0, 8)].'"></i> '.str_replace('_', ' ',$sub->module_title).'</a></li>';
          
            //$colornum++;
            }  
         echo '</ul>
        </li>';
          //$mcolornum++;
           }
        
        ?>
        
       
        
        
        <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-tablet text-aqua"></i> <span>Notes(Todos)</span>
          </a>
        </li>
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-aqua"></i> <span>Unit Disscussion</span>
          </a>
        </li>
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-street-view text-aqua"></i> <span>Help Us Improve</span>
          </a>
        </li> 
        
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-folder text-aqua"></i> <span>Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('contract.type') }}"><i class="fa fa-circle-o text-aqua"></i> Contract Type</a></li>
            <li><a href="{{ route('contract.owner') }}"><i class="fa fa-circle-o text-red"></i> Owner</a></li>
            <li><a href="{{ route('contract.client') }}"><i class="fa fa-circle-o text-red"></i> Clients</a></li>
            <li><a href="{{ route('contract.client') }}"><i class="fa fa-circle-o text-black"></i> Setup User</a></li>
            <li><a href="{{ route('contract.client') }}"><i class="fa fa-circle-o text-success"></i> Email Notification</a></li>
            <li><a href="{{ route('email.notify') }}"><i class="fa fa-circle-o text-fuchsia"></i> Set Email Content</a></li>
            <li><a href="{{ route('mail.config') }}"><i class="fa fa-circle-o text-green"></i> Mail Configuration</a></li>
            <li><a href="{{ route('settings') }}"><i class="fa fa-circle-o text-danger"></i> Site Settings</a></li> 
          </ul>
        </li>-->
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">C&ILeasing PLC</a>.</strong> All rights
    reserved.
  </footer>

 

</div>
<!-- ./wrapper -->




<!-- DataTables -->
<script src="{{ URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ) }}"></script>
<!-- SlimScroll -->
<script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js' ) }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('dist/js/pages/dashboard2.js' ) }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('dist/js/demo.js' ) }}"></script>
<script src="{{ URL::asset('toastr/toastr.min.js') }}"></script>



 <script>
    @if(Session::has('success'))

      toastr.success("{{ Session::get('success') }}");

    @endif

    @if(Session::has('info'))

      toastr.info("{{ Session::get('info') }}");

    @endif

    @if(Session::has('warning'))

      toastr.warning("{{ Session::get('warning') }}");

    @endif
  </script>
  
  
  
<!-- page script -->
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.1/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.5.0/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>



<script src="{{ URL::asset('dist/build/pdfmake.js') }}"></script>
<script src="{{ URL::asset('dist/build/vfs_fonts.js') }}"></script> 
  
  
<!-- DATE PICKER BEGINS HERE -->
            <!-- Select2 -->
            <script src="{{ URL::asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
            <!-- date-range-picker -->
            <script src="{{ URL::asset('bower_components/moment/min/moment.min.js') }}"></script>
            <script src="{{ URL::asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
            
            
            <!-- bootstrap datepicker -->
            <script src="{{ URL::asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
            <!-- bootstrap color picker -->
            <script src="{{ URL::asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
            <!-- bootstrap time picker -->
            <script src="{{ URL::asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
            <!-- iCheck 1.0.1 -->
            <script src="{{ URL::asset('plugins/iCheck/icheck.min.js') }}"></script>
            
            <!-- SlimScroll -->
        <script src="{{ URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
            
            <!-- bootstrap time picker -->
        <script src="{{ URL::asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
 
  
  <script>
        //Date picker
        $('.datepicker').datepicker({
autoclose: true,
        format: 'yyyy-mm-dd'
})

  $('.timepicker').timepicker({
      showInputs: false
    })

        //Initialize Select2 Elements
        $('.select2').select2()

</script> 
  
<script>
    
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false, 
      'deferRender' : true,
      'select' : true,
      'dom' : 'Bfrtip',
      'lengthMenu' : [10, 25, 50, 75, 100, 200, -1],
      buttons: [
   {
    text: '<i class="fa fa-refresh"></i>',
    action: function () {
     table.ajax.reload();
    }
   },   
   {
   extend: 'collection',
   autoClose: true,
                text: '<i class="fa fa-file"></i> Export',
                buttons: [
    {
     extend: 'copy',
     exportOptions: {
      modifier: {
       selected: true
      }
     }      
    },
    {
     extend: 'pdf',
     orientation: 'landscape',
     pageSize: 'A4',
     footer: true,
     header: true,
     messageBottom: 'tbs',
     filename: 'tbs_0987654',
     title: 'tbs',
     exportOptions: {
      modifier: {
       selected: true
      }
     }      
    },
    {
     extend: 'csv',
     exportOptions: {
      modifier: {
       selected: true
      }
     }      
    },
    {
     extend: 'excel',
     exportOptions: {
      modifier: {
       selected: true
      }
     }      
    },
    {
     extend: 'print',
     exportOptions: {
      modifier: {
       selected: true
      }
     }      
    },
   ]},
   {
   extend: 'collection',
   autoClose: true,
                text: '<i class="fa fa-bars"></i> Selection',
                buttons: [
    'selectAll',
    'selectNone',
    'selectRows',
    'selectColumns',
    'selectCells'
   ]},
   'colvis',
   'pageLength',
   
  ],    
    })
    
    })
</script>
</body>
</html>
