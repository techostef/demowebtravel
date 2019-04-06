<?php 
$admin = UserApp::viewdata('user_level'); 
$access = session('role'); 
?>
<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{config('app.url').'/home'}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
        </li>
        <h3 class="menu-title">Kantor</h3><!-- /.menu-title -->
        @if($admin==-1||in_array('list_daftar_karyawan',$access)||in_array('list_restore_karyawan',$access))
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <i class="menu-icon fa fa-laptop"></i>Komponen
            </a>
            <ul class="sub-menu children dropdown-menu">
                @if($admin==-1||in_array('list_daftar_karyawan',$access))
                    <li>
                        <i class="fa fa-id-badge"></i>
                        <a href="{{config('app.url').'/user/karyawan'}}">Karyawan</a>
                    </li>
                @endif
                @if($admin==-1||in_array('list_restore_karyawan',$access))
                    <li>
                        <i class="fa fa-id-badge"></i>
                        <a href="{{config('app.url').'/user/karyawan_restore'}}">Restore Karyawan</a>
                    </li>
                @endif
                @if($admin==-1)
                    <li>
                        <i class="fa fa-id-badge"></i>
                        <a href="{{config('app.url').'/user/karyawan_level'}}">Karyawan Level</a>
                    </li>
                @endif
                @if($admin==-1)
                    <li>
                        <i class="fa fa-id-badge"></i>
                        <a href="{{config('app.url').'/user/karyawan_level_restore'}}">Restore Karyawan Level</a>
                    </li>
                @endif
            </ul>
        </li>
        @endif
        @if($admin==-1||in_array('list_daftar_customer',$access)||in_array('list_restore_customer',$access))
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <i class="menu-icon fa fa-laptop"></i>Customer
            </a>
            <ul class="sub-menu children dropdown-menu">
                @if($admin==-1||in_array('list_daftar_customer',$access))
                <li>
                    <i class="menu-icon fa fa-laptop"></i>
                    <a href="{{config('app.url').'/customer'}}">
                        Daftar Customer
                    </a>
                </li>
                @endif
                @if($admin==-1||in_array('list_restore_customer',$access))
                <li>
                    <i class="menu-icon fa fa-laptop"></i>
                    <a href="{{config('app.url').'/customer_restore'}}">
                        Restore Customer
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if($admin==-1||in_array('list_daftar_transaction_order',$access)||in_array('list_restore_transaction_order',$access))
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                <i class="menu-icon fa fa-laptop"></i>Transaction
            </a>
            <ul class="sub-menu children dropdown-menu">
                @if($admin==-1||in_array('list_daftar_transaction_order',$access))
                <li>
                    <i class="menu-icon fa fa-laptop"></i>
                    <a href="{{config('app.url').'/transaction'}}">
                        List Transaction
                    </a>
                </li>
                @endif
                @if($admin==-1||in_array('list_restore_transaction_order',$access))
                <li>
                    <i class="menu-icon fa fa-laptop"></i>
                    <a href="{{config('app.url').'/transaction_restore'}}">
                        Restore Transaction
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
    </ul>
</div>