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
                    @if(UserApp::checkrole(14))
                    <a title='Edit Customer' data-href="{{config('app.url')."/customer/edit/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-primary btn-sm loadview">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endif
                    @if(UserApp::checkrole(77))
                    <a title='Edit Customer' data-href="{{config('app.url')."/customer/delete/".urlencode(Secure::encode($val['id']))}}" class="btn btn-outline-danger btn-sm">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    @endif
                </td>
            </tr>
            <?php $no++;?>
        @endforeach
    </tbody>
</table>