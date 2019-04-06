@extends('layout.main')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Data Karyawan Level</strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($result as $val)
                        <tr>
                            <td>{{$val['name']}}</td>
                            <td style="width:50px">
                                @if(UserApp::checkrole(163))
                                <a href="{{config('app.url')."/user_level/restore/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm restoredata"
                                title="Restore Data"
                                >
                                    <i class="fa fa-mail-reply"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole(99))
                                <button data-toggle="modal" data-target="#historyModal" a="{{urlencode(Secure::encode('user_level'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openhistory"
                                title="History"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </button>
                                @endif
                                @if(UserApp::checkrole(99))
                                <a  href="{{config('app.url')."/user_level/delete_permanent/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm deletedata" 
                                title="Delete Permanent"
                                >
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