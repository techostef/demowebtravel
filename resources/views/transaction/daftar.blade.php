@extends('layout.main')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Transaction</strong>
            @if(UserApp::checkrole('tambah_daftar_transaction_order'))
            <a href="{{config('app.url').'/transaction/tambah'}}" class="btn btn-primary pull-right">Tambah</a>
            @endif
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Date</th>
                    <th>total_item</th>
                    <th>total_price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach($result as $val)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$val['code']}}</td>
                            <td>{{$val['date']}}</td>
                            <td>{{$val['total_item']}}</td>
                            <td>{{number_format($val['total_price'],2)}}</td>
                            <td style="width:50px">
                                @if(UserApp::checkrole('ubah_daftar_transaction_order'))
                                <a 
                                title="Edit"
                                href="{{config('app.url')."/transaction/edit/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole('lihat_daftar_transaction_order'))
                                <a 
                                title="View"
                                href="{{config('app.url')."/transaction/view/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole('history_daftar_transaction_order'))
                                <button data-toggle="modal" data-target="#historyModal" a="{{urlencode(Secure::encode('transaction'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openhistory"
                                title="History"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </button>
                                @endif
                                @if(UserApp::checkrole('hapus_daftar_transaction_order'))
                                <a 
                                title="Delete"
                                href="{{config('app.url')."/transaction/delete/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm deletedata">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                    <?php $no++;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@include('inc.history')

<script type="text/javascript">
    $(document).ready(function() {
        $(".deletedata").click(function(e){
            e.preventDefault();
            if(confirm("Anda yakin ingin menghapus?")){
                window.location = $(this).attr("href");
            }
        })
        $('#bootstrap-data-table').DataTable();

        //scroll mouse down
        var down = false;
        var scrollLeft,x,temp,$this;
        $('body').on('mousedown','.dataTables_scrollBody',function(e) {
            e.preventDefault();
            down = true;
            scrollLeft = this.scrollLeft;
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