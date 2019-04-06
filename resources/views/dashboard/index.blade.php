@extends('layout.main')

@section('content')
<?php
$admin = UserApp::viewdata('flag'); 
$access = UserApp::getrole_array($user['id_users']);
?>
    <style>
        .small-box{
            border-radius: 2px;
            position: relative;
            display: block;
            margin-bottom: 20px;
            color:white !important;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        }
        .small-box > .inner{
            padding: 10px;
        }
        .small-box p{
            color:white !important;
        }
        .small-box h3{
            font-size: 38px;
            font-weight: bold;
            height:45px;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }
        .small-box>.small-box-footer{
            position: relative;
            text-align: center;
            padding: 3px 0;
            color: #fff;
            color: rgba(255,255,255,0.8);
            display: block;
            z-index: 10;
            background: rgba(0,0,0,0.1);
            text-decoration: none;
        }
        .small-box:hover .icon {
            font-size: 95px;
        }
        .small-box .icon{
            -webkit-transition: all .3s linear;
            -o-transition: all .3s linear;
            transition: all .3s linear;
            position: absolute;
            top: -10px;
            right: 10px;
            z-index: 0;
            font-size: 90px;
            color: rgba(0,0,0,0.15);
        }
        .bg-aqua{
            background-color: #00c0ef !important;
        }
        .bg-green{
            background-color: #00a65a !important;
        }
        .bg-yellow{
            background-color: #f39c12 !important
        }
        .bg-red{
            background-color: #dd4b39 !important
        }
    </style>
    <div class="container">
        <div class="row">
            @if($admin==1||in_array('120',$access))
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3></h3>
      
                    <p>Karyawan</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-id-badge"></i>
                  </div>
                  <a href="{{config('app.url').'/user/karyawan'}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif

              <!-- ./col -->
              @if($admin==1||in_array('52',$access))

              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3></h3>
      
                    <p>Nasabah</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-id-badge"></i>
                  </div>
                  <a href="{{config('app.url').'/nasabah/daftar'}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif

            @if($admin==1||in_array('885',$access))

              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3></h3>
      
                    <p>Tabungan</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-save"></i>
                  </div>
                  <a href="{{config('app.url').'/tabungan/daftar'}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif
            @if($admin==1||in_array('418',$access))
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3></h3>
      
                    <p>Kredit</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-credit-card"></i>
                  </div>
                  <a href="{{config('app.url').'/kredit/daftar'}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif
        </div>
    </div>
@endsection