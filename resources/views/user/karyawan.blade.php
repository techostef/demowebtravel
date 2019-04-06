@extends('layout.main')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Data Karyawan</strong>
            @if(UserApp::checkrole("tambah_daftar_karyawan"))
            <a href="{{config('app.url').'/user/tambah'}}" class="btn btn-primary pull-right">Tambah</a>
            @endif
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($result as $val)
                        <tr>
                            <td>{{$val['name']}}</td>
                            <td>{{$val['address']}}</td>
                            <td style="width:50px">
                                @if($val['user_level']==-1)
                                <?php continue;?>
                                @endif
                                @if(UserApp::checkrole("ubah_daftar_karyawan"))
                                <a href="{{config('app.url')."/user/edit/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole("lihat_daftar_karyawan"))
                                <a href="{{config('app.url')."/user/view/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole("history_daftar_karyawan"))
                                <button data-toggle="modal" data-target="#historyModal" a="{{urlencode(Secure::encode('user'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openhistory"
                                title="History"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </button>
                                @endif
                                @if(UserApp::checkrole("hapus_daftar_karyawan"))
                                <a href="{{config('app.url')."/user/delete/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('inc.history')

<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table').DataTable();

        //scroll mouse down
        var down = false;
        var scrollLeft,x,temp,$this;
        $('body').on('mousedown','.dataTables_scrollBody',function(e) {
            e.preventDefault();
            down = true;
            scrollLeft = this.scrollLeft;
            console.log('scrollLeft',scrollLeft);
            x = e.clientX;
            $this = this;
        }).mouseup(function() {
            down = false;
        }).mousemove(function(e) {
            if (down) {
                temp = scrollLeft + x - e.clientX;
                $this.scrollLeft = temp;
            }
        }).mouseleave(function() {
            down = false;
        })
    });
</script>
@endsection