@extends('layout.main')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Daftar Customer</strong>
            @if(UserApp::checkrole('tambah_daftar_customer'))
            <button data-title="Tambah Customer" data-backdrop="false" data-href="{{config('app.url').'/customer/tambah'}}" class="btn btn-primary pull-right loadview">Tambah</button>
            <a href="{{config('app.url').'/customer/print'}}" style="margin-right:10px;" class="btn btn-success pull-right">Print</a>
            @endif
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="listdatacustomer">
                    <?php $no=1;?>
                    @foreach($result as $val)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$val['code']}}</td>
                            <td>{{$val['name']}}</td>
                            <td>{{$val['city']}}</td>
                            <td style="width:100px">
                                @if(UserApp::checkrole('ubah_daftar_customer'))
                                <a title='Edit Customer' data-href="{{config('app.url')."/customer/edit/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm loadview">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole('lihat_daftar_customer'))
                                <a title='View Customer' data-type='view' data-href="{{config('app.url')."/customer/view/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm loadview">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @endif
                                @if(UserApp::checkrole('history_daftar_customer'))
                                <button data-target="#historyModal" a="{{urlencode(Secure::encode('customer'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openmodal openhistory"
                                title="History"
                                >
                                    <i class="fa fa-file-text-o"></i>
                                </button>
                                @endif
                                @if(UserApp::checkrole('hapus_daftar_customer'))
                                <button title='Delete Customer' data-href="{{config('app.url')."/customer/delete/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm deletedata">
                                    <i class="fa fa-trash-o"></i>
                                </button>
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
@include('customer.modal')
@include('inc.history')
<script type="text/javascript">
    var url,target;
    $("body").on("click",".openmodal",function(){
        target = $($(this).attr("data-target"));
        target.show().removeClass("fade");
        target.find("button").click(function(){
            target.hide();
        })
    });
    $("body").on("click",".deletedata",function(){
        url = $(this).attr('data-href');
        if(confirm("Anda Yakin ingin menghapus?")){
            addLoading();
            $.ajax({
                url:url,
                success:function(data){
                    try{
                        data = JSON.parse(data);
                        if(data.status==true){
                            successmsg(data.msg);
                            updatelist();
                        }else{
                            errormsg(data.msg);
                        }
                    }catch(err){
                        console.log(data);
                        removeLoading();
                    }
                }
            })
            .fail(function(){
                removeLoading();
                errormsg("Gagal terkoneksi ke server");
            })
            .done(function(){
                removeLoading();
            })
        }
    })
    function updatelist(){
        $(".card-body").html("");
        loadModal.find(".modal-title").text($(this).attr("data-title"));
        $.ajax({
            url: "{{config('app.url')}}/customer/list", // form action url
            cache: false,
            dataType: "html",
            beforeSend:function(){
                addLoading();
            },
            afterSend: function() {
                removeLoading();
            },
            success: function(data){
                try{
                    $('.card-body').html(data).fadeIn();
                    $('#bootstrap-data-table').DataTable();
                }catch(err){
                    console.log(err);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
        .fail(function(){
            removeLoading();
            errormsg("Gagal terkoneksi ke server");
        })
        .done(function(){
            removeLoading();
        })
    }


    $(document).ready(function() {
      $('#bootstrap-data-table').DataTable();
    });

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
</script>
@endsection