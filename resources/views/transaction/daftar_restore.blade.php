@extends('layout.main')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Restore Transaction</strong>
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

                                @if(UserApp::checkrole('restore_restore_transaction_order'))
                                <a href="{{config('app.url')."/transaction/restore/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm restoredata"
                                title="Restore Data"
                                >
                                    <i class="fa fa-mail-reply"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole('history_daftar_transaction_order'))
                                <button data-toggle="modal" data-target="#historyModal" a="{{urlencode(Secure::encode('transaction'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openhistory"
                                title="History"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </button>
                                @endif
                                @if(UserApp::checkrole('restore_delete_transaction_order'))
                                <a  href="{{config('app.url')."/transaction/delete_permanent/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm deletedata" 
                                title="Delete Permanent"
                                >
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
        $(".restoredata").click(function(e){
            e.preventDefault();
            if(confirm("Anda yakin ingin mengembalikan data?")){
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