<div class="row form-group">
    @if(isset($id_select))
    <input type="hidden" name='id' value="{{$id_select}}">
    @endif
    <div class="col col-md-2">
        <label class="form-control-label">Code <span style="color:red">*</span></label>
    </div>
    <div class="col-12 col-md-10">
        <?php 
            $a = '';
            if(isset($data['code'])){
                $a = $data['code'];
            }
        ?>
        {{Form::text('code',$a,
        ['placeholder'=>'Code','class'=>'form-control','required','autocomplete'=>'off']
        )}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-2">
        <label for="text-input" class=" form-control-label">Name <span style="color:red">*</span></label>
    </div>
    <div class="col-12 col-md-10">
        <?php 
            $nama = '';
            if(isset($data['name'])){
                $nama = $data['name'];
            }
        ?>
        {{Form::text('nama',$nama,
        ['placeholder'=>'Name','class'=>'form-control','required','autocomplete'=>'off']
        )}}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-2">
        <label for="text-input" class=" form-control-label">City </label>
    </div>
    <div class="col-12 col-md-10">
        @if(isset($view)&&$view==true)
            <label>{{$data['city']}}</label>
        @else
        <select name='city' required class="combobox form-control">
            <option value="">City</option>
            @if(isset($city)&&is_array($city))
                @foreach ($city as $r3)
                    <option value="{{$r3['nama_kabkota']}}" 
                    @if(isset($data['city'])&&$r3['nama_kabkota']==$data['city'])
                        selected
                    @endif
                    >{{$r3['nama_kabkota']}}</option>
                @endforeach
            @endif
        </select>
        @endif
    </div>
</div>
<button type="submit" id="submitForm" style="display:none">submit</button>
<script src="{{asset('js/bootstrap-combobox.js')}}" type="text/javascript"></script>

<script>
    $(".combobox").combobox();
</script>
<script>
    var submitForm = $("#submitForm");
    var theForm = $("#theForm");
    var status ;
    function submitform(){

        status = checkForm("theForm");
        if(status==1){
            errormsg("Tolong input dengan benar");
            return false;
        }
        
        $.ajax({
            url: theForm.attr("action"), // form action url
            type: "post",
            cache: false,
            data: theForm.serialize(),
            beforeSend:function(){
            },
            afterSend: function() {
            },
            success: function(data){
                try{
                    data = JSON.parse(data);
                    if(data.status==true){
                        successmsg(data.msg);
                        updatelist();
                        $("#loadModal").hide();
                    }else{
                        errormsg(data.msg);
                    }
                }catch(err){
                    console.log(err);
                }
            },
            error: function(e) {
                console.log(e);
            }
        })
        .fail(function(){
            errormsg("Gagal terkoneksi ke server");
        })
        .done(function(){
        })
    }
    // submitForm.click(function(e){
        
    // })
    jQuery(document).ready(function($){
        function readURL(input,target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        var a = $("#selectLg");
        a.val(a.attr('data-set'));
    });
    
</script>
@if(isset($view)&&$view==true)
<script>
toView("theForm");
disableInput("theForm");
</script>
@endif
    