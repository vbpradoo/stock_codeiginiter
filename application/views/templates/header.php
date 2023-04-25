<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page_title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/fontawesome-free-5.3.1-web/css/fontawesome.min.css') ?>">
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
    <!-- Morris chart -->
    <!--    <link rel="stylesheet" href="--><?php //echo base_url('assets/bower_components/morris.js/morris.css') ?><!--">-->
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css') ?>">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
          href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
<!--    <link rel="stylesheet"-->
<!--          href="--><?php //echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?><!--">-->
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">

    <!-- icheck -->
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- Morris.js charts -->
<!--    <script src="--><?php //echo base_url('assets/bower_components/raphael/raphael.min.js') ?><!--"></script>-->
    <!--    <script src="--><?php //echo base_url('assets/bower_components/morris.js/morris.min.js') ?><!--"></script>-->
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
<!--    <script src="--><?php //echo base_url('assets/bower_components/moment/min/moment.min.js') ?><!--"></script>-->
    <script src="<?php echo base_url('assets/bower_components/moment2/moment.min.js') ?>"></script>
    <script>moment.updateLocale('es',null)</script>

    <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/bower_components/moment/locale/es.js') ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"') ?>" />

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>

    <!-- ChartJS -->
        <script src="<?php echo base_url('assets/bower_components/chart.js/Chart.min.js') ?>"></script>

    <!-- icheck -->
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>

    <!-- DataTables -->
    <!--    <script src="--><?php //echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?><!--"></script>-->
    <!--    <script src="--><?php //echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?><!--"></script>-->

    <!-- DataTables jsGRID -->
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url('assets/plugins/jsgrid-1.5.3/dist/jsgrid.min.css') ?><!--"/>-->
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url('assets/plugins/jsgrid-1.5.3/dist/jsgrid-theme.min.css') ?><!--"/>-->
    <!--    <script src="--><?php //echo base_url('assets/plugins/jsgrid-1.5.3/dist/jsgrid.min.js') ?><!--"></script>-->
    <!-- DataTables jqGrid-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/jqGrid/css/ui.jqgrid.css') ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/jqGrid/css/theme-jqgrid.css') ?>"/>
    <!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url('assets/plugins/jqGrid/css/ui-lightness/jquery-ui-1.7.1.custom.css') ?><!--"/>-->
    <!--    <script src="--><?php //echo base_url('assets/plugins/jqGrid/js/jquery-1.4.2.min.js') ?><!--"> type="text/javascript"></script>-->
    <script src="<?php echo base_url('assets/plugins/jqGrid/js/i18n/grid.locale-es.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jqGrid/js/jquery.jqGrid.js') ?>"></script>

    <!--Dropzone-->
<!--    <script src="--><?php //echo base_url('assets/bower_components/dropzone/dropzone.min.js') ?><!--"></script>-->
<!--    <link type="text/css" rel="stylesheet" href="--><?php //echo base_url('assets/bower_components/dropzone/dropzone.min.css') ?><!--"/>-->

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/favicon/apple-touch-icon-57x57.png')?>" >
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/favicon/apple-touch-icon-114x114.png')?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/favicon/apple-touch-icon-72x72.png')?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/favicon/apple-touch-icon-144x144.png')?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/favicon/apple-touch-icon-60x60.png')?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/favicon/apple-touch-icon-120x120.png')?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/favicon/apple-touch-icon-76x76.png')?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/favicon/apple-touch-icon-152x152.png')?>">
<!--    <link rel="icon" type="image/png" href="--><?php //echo base_url('assets/favicon/favicon-196x196.png')?><!--" sizes="196x196">-->
<!--    <link rel="icon" type="image/png" href="--><?php //echo base_url('assets/favicon/favicon-160x160.png')?><!--" sizes="160x160">-->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon/favicon-96x96.png')?>" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon/favicon-16x16.png')?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon/favicon-32x32.png')?>" sizes="32x32">




</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

