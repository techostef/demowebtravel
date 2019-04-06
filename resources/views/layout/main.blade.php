<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('scss/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/combobox.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <script src="{{asset('js/vendor/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/moment.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/moneyO.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/loadingO.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/datesO.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugin/datepicker/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-combobox.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootbox.js')}}" type="text/javascript"></script>
    <script>
    jQuery(document).ready(function($){
        $(".tanggalpicker").each(function () {
            $(this).datepicker({
                format: "yyyy-mm-dd"
            });
        });
    })
    </script>


</head>
<body>
    <div id='msgsuccess' class="alert alert-success" style="display:none;position:absolute;top:20px;right:20px;z-index:9999">
        success
    </div>
    <div id='msgerror' class="alert alert-danger" style="display:none;position:absolute;top:20px;right:20px;z-index:9999">
        error
    </div>

        <!-- Left Panel -->

    @include('inc.aside')

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('inc.header')
        <!-- Header-->

        @include('inc.breadcrumbs')

        @include('inc.message')

        @yield('content')
        
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script>
        function successmsg(msg){
            $("#msgerror").hide(500);
            msg = msg?msg:"Success";
            $("#msgsuccess").show(500).text(msg);
            setTimeout(function(){
                $("#msgsuccess").hide(500);
            },2000)
        }
        function errormsg(msg){
            $("#msgsuccess").hide(500);
            msg = msg?msg:"Success";
            $("#msgerror").show(500).text(msg);
            setTimeout(function(){
                $("#msgerror").hide(500);
            },2000)
        }
    </script>
    <script src="{{asset('js/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/data-table/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/data-table/datatables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/lib/data-table/datatables.buttons.min.js')}}" type="text/javascript"></script>
</body>
</html>
