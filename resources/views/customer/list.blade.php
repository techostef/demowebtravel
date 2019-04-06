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
                    <button data-target="#historyModal" a="{{urlencode(Secure::encode('customer'))}}" b="{{urlencode(Secure::encode('id='.$val['id']))}}" class="btn btn-outline-info btn-sm openhistory openmodal"
                    title="History"
                    >
                        <i class="fa fa-file-text-o"></i>
                    </button>
                    @endif
                    @if(UserApp::checkrole('hapus_daftar_customer'))
                    <a title='Delete Customer' data-href="{{config('app.url')."/customer/delete/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm deletedata">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    @endif
                </td>
            </tr>
            <?php $no++;?>
        @endforeach
    </tbody>
</table>