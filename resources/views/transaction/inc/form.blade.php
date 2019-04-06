<div class="card">
    <div class="card-header">
        <strong><?php 
            echo empty($userData)?"Tambah":"update";
            ?> 
            Transaction</strong>
    </div>

    <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Code <span style="color:red">*</span></label>
            </div>
            @if(isset($id_select))
            <input type="hidden" name='id' value="{{$id_select}}">
            @endif
            <div class="col-12 col-md-9">
                <?php 
                    $nama = '';
                    if(isset($userData['code'])){
                        $nama = $userData['code'];
                    }
                ?>
                {{Form::text('code',$nama,
                ['placeholder'=>'Code','class'=>'form-control','required','autocomplete'=>'off']
                )}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class="form-control-label">Tanggal</label>
            </div>
            <div class="col-12 col-md-9">
                <?php 
                    $a = '';
                    if(isset($userData['date'])){
                        $a = $userData['date'];
                    }
                ?>
                {{Form::text('date',$a,
                ['id'=>'date','required','placeholder'=>'Tanggal','class'=>'form-control tanggalpicker','autocomplete'=>'off','readonly']
                )}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="selectLg" class=" form-control-label">Customer <span style="color:red">*</span></label>
            </div>
            <div class="col-12 col-md-9">
                @if(isset($view)&&$view==true)
                <label>@if(isset($userData['name_customer'])){{$userData['name_customer']}}@endif</label>
                @else
                <select name='customer' required class="combobox form-control">
                    <option value="">Customer</option>
                    @if(isset($customer)&&is_array($customer))
                        @foreach ($customer as $r3)
                            <option value="{{Secure::encode($r3['id'])}}" 
                            @if(isset($userData['id_customer'])&&$r3['id']==$userData['id_customer'])
                                selected
                            @endif
                            >{{$r3['code']}} - {{$r3['name']}}</option>
                        @endforeach
                    @endif
                </select>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="selectLg" class=" form-control-label">City <span style="color:red">*</span></label>
            </div>
            <div class="col-12 col-md-9">
                @if(isset($view)&&$view==true)
                <label>@if(isset($userData['city'])){{$userData['city']}}@endif</label>
                @else
                <select name='city' required class="combobox1 form-control">
                    <option value="">City</option>
                    @if(isset($city)&&is_array($city))
                        @foreach ($city as $r3)
                            <option value="{{$r3['nama_kabkota']}}" 
                            @if(isset($userData['city'])&&$r3['nama_kabkota']==$userData['city'])
                                selected
                            @endif
                            >{{$r3['nama_kabkota']}}</option>
                        @endforeach
                    @endif
                </select>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Total Item</label>
            </div>
            <div class="col-12 col-md-9">
                <?php 
                    $nama = '';
                    if(isset($userData['total_item'])){
                        $nama = $userData['total_item'];
                    }
                ?>
                {{Form::text('total_item',$nama,
                ['id'=>'total_item','placeholder'=>'Total Item','class'=>'form-control','readonly','autocomplete'=>'off']
                )}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Total Price</label>
            </div>
            <div class="col-12 col-md-9">
                <?php 
                    $nama = '';
                    if(isset($userData['total_price'])){
                        $nama = number_format($userData['total_price'],2);
                    }
                ?>
                {{Form::text('total_price',$nama,
                ['id'=>'total_price','placeholder'=>'Total Price','class'=>'form-control','readonly','autocomplete'=>'off']
                )}}
            </div>
        </div>
        @include('transaction.inc.detail')
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
    </div>
</div>
<script>
    $(".tanggalpicker").each(function () {
        $(this).datepicker({
            format: "dd/mm/yyyy"
        });
    });
    var c = $('.combobox1').combobox();
  
    var a = $('.combobox').combobox({
        onchangevalue:function(val){
            addLoading();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"post",
                url:"{{config('app.url')}}/customer/getinfo",
                data:{a:val},
                success:function(data){
                    try{
                        data = JSON.parse(data);
                        if(data.status==true){
                            c.combobox({
                                select:data.result
                            });
                        }else{
                            errormsg(data.msg);
                        }
                    }catch(err){
                        console.log(err);
                    }
                }
            })
            .fail(function(){
                errormsg("Gagal terkoneksi dengan server");
                removeLoading();
            })
            .done(function(){
                removeLoading();
            })
        }
    });
</script>

@if(isset($view)&&$view==true)
<script>
toView("theForm");
disableInput("theForm");
</script>
@endif