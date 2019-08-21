@extends('layouts.layout')

@section('content')


 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
 

<!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          
          <?php
            $color = ['red', 'blue', 'yellow', 'orange', 'black', 'teal', 'green'];
            $icon = ['ion ion-ios-gear-outline', 'fa fa-google-plus', 'ion ion-ios-cart-outline', 'ion ion-ios-people-outline'];
            
          ?>
          
          <?php
            if($dashboard){
               
                foreach($dashboard as $get){
                    $module_title = $get->module_title;
                    $module_db_table = $get->module_db_table;
                    $module_table = $get->module_table;
                    $must_set = $get->must_set;
                    $module_url = $get->module_url;
                    $directsql = $get->direct_sql;
                    $dashboard_sum = $get->dashboard_sum;
                    $dashboard_display = $get->dashboard_display;
                    $module_category = $get->module_category;
                    $getcategoryicon = App\Category::where('category_id', '=',  $module_category)->value('category_icon');
                    $getModel= 'App\\' .$module_table;
                    $must_set = ($must_set != '0') ? $must_set.' AND ' : '';
                    $doGet = trim($directsql) != '0' && trim($directsql) != '' ? collect(DB::select(DB::raw($directsql))) : $getModel::where(DB::raw($must_set.' del'), '=', '0')->get();
                    $doGetSUM = $getModel::select(DB::raw('SUM('.$dashboard_sum.')'))->where(DB::raw($must_set.' del'), '=', '0')->value($dashboard_sum);
                    $doGetSUMRAW = "SELECT SUM($dashboard_sum) as totalSum FROM $module_db_table WHERE $must_set del = '0'"; 
                    $d = (trim($dashboard_sum) != '0') ? collect(DB::select(DB::raw($doGetSUMRAW))) : '';
                    if($d){
                        foreach($d as $dget){
                            $totalSum = $dget->totalSum;
                        }
                    }
                    
                    //$getModel::select(DB::raw('SUM('.$dashboard_sum.')'))->where(DB::raw($must_set.' del'), '=', '0')->value($dashboard_sum);
                    $doCount = count($doGet);
             
          ?>
          
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-<?php echo $color[rand(0, count($color) -1)]; ?>"><i class="fa fa-{{ $getcategoryicon}}"></i></span>

            <a href="{{ env('APP_URL'). '/display/'. $module_url }}" style="color:black"><div class="info-box-content">
               <span title="{{ $module_title }}" class="info-box-text">{{  $module_title }}</span>
              <span class="info-box-number">{{ $doCount }} <small style="vertical-align: text-top;"><i style="color:red; font-size:9px" class="fa fa-arrow-up"></i></span></small></span>
              <span class="info-box-text">{{ $totalSum }}</span>
            </div></a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        
        <?php
                }
            }
        ?>

       
      </div>
      <!-- /.row -->

      
      
      
      
      
      
      
        
      <div class="row">
        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Income</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        

          <!-- BAR CHART -->
          
          <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Expenditure</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 </div>
      </div>
      <!-- /.row -->
      
      
      
      

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        
        <?php 
         if($displayItems){
               
                foreach($displayItems as $getdisplay){
                    
        ?>

        <div class="col-md-4">
          <!-- MAP & BOX PANE -->
          
            <?php
                $topColor = ['info', 'success', 'primary', 'danger', 'secondary'];
            ?>
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-<?php echo $topColor[rand(0, count($topColor) - 1)]; ?>">
          
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added {{ $getdisplay->module_title }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                     <?php
			  $idisplayitems = explode(',', $getdisplay->dashboard_display);
			  foreach($idisplayitems as $item){
				  echo ' <th>'.ucfirst(str_replace('_', ' ', trim($item))).'</th>';				  
			  }
			  ?>      
                    
                  </tr>
                  </thead>
                  <tbody>
                 
                 
                 <?php
                 
                 $dodashboardDisplay = "SELECT * FROM ".$getdisplay->module_db_table." WHERE del = '0' ORDER BY ".$getdisplay->module_order_by." LIMIT 7"; 
                 $dashboard_display_data =  collect(DB::select(DB::raw($dodashboardDisplay)));
                 foreach($dashboard_display_data as $dd_data){
                     $displayitem1 = trim($idisplayitems[0]);
                     $displayitem2 = trim($idisplayitems[1]);
                     $displayitem3 = trim($idisplayitems[2]);
                ?>
                  <tr> 
                    <td>{{ $dd_data->$displayitem1 }}</td>
                    <td><span class="label label-success">{{ $dd_data->$displayitem2 }}</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $dd_data->$displayitem3 }}</div>
                    </td>
                  </tr>
                <?php
                 }
                 ?>
                  
                  
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
               <a href="form/{{ $getdisplay->module_url }}" class="btn btn-xs btn-danger btn-flat pull-left">Add New</a>
              <a href="display/{{ $getdisplay->module_url }}" class="btn btn-xs btn-success btn-flat pull-right">View All</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->        
        <?php
                }
             
         }
        
        ?>
        

        <div class="col-md-4">
          <!-- 
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Added People</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
          
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-img">
                    <img src="dist/img/default-50x50.gif" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">Samsung TV
                      <span class="label label-warning pull-right">$1800</span></a>
                    <span class="product-description">
                          Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span>
                  </div>
                </li>
               
               
              </ul>
            </div>
          
            <div class="box-footer text-center">
              <a href="javascript:void(0)" class="uppercase">View All Products</a>
            </div>
          
          </div>
         
        </div>
        -->
      </div>
      <!-- /.row -->
      
      
      
    </section>

<!-- FastClick -->
 <script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- ChartJS -->
<script src="{{ URL::asset('bower_components/chart.js/Chart.js' ) }}"></script>  
<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 700,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Chrome'
      },
      {
        value    : 500,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'IE'
      },
      {
        value    : 400,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'FireFox'
      },
      {
        value    : 600,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Safari'
      },
      {
        value    : 300,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Opera'
      },
      {
        value    : 100,
        color    : '#d2d6de',
        highlight: '#d2d6de',
        label    : 'Navigator'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

    //-------------
    //- BAR CHART -
    //-------------
    
     var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    }
    
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>

@endsection