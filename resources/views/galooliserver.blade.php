<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sys Manager | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Galooli </b>Trip Reports</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Test</p>

    
            <?php
            echo $_SERVER['SCRIPT_NAME'];
            ?>
          <!-- <div class="form-group">
                        <div id="fromgalooli"></div>
                    </div>-->
              <div id="fromgalooli"></div>
                <label>Vehicle Name: </label> <small style="color:grey; margin-left:10px">(format : AKD 736 MU)</small>
                <form name="galoliform" id="galoliform" onSubmit="return false;">
                    <select class="form-control select2" style="width: 100%;" id="vehic_name" name="vehic_name">
                        <option>Select</option>
                    </select>

                    <center><br/><input type="hidden" name="dType" id="dType" value="fueling" />
                        <button hidden type="submit" onClick="process()" class="btn btn-primary btn-fill btn-xs">Process</button></center><br/>
                 </form>

     
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="{{ URL::asset('js/global.js') }}"></script>

<script src="{{ URL::asset('js/gal.js') }}"></script>
</body>
</html>
