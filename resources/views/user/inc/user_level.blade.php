<div class="card">
   
    <div class="card-header">
        <strong>
        @if(isset($data))
        {{'Ubah'}}
        @else
        {{'Tambah'}}
        @endif Permission</strong>
    </div>

    <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Nama Karyawan Level <span style="color:red">*</span></label>
            </div>
            <div class="col-12 col-md-9">
                {{Form::hidden('id',isset($data['id'])?Secure::encode($data['id']):"")}}
                {{Form::text('nama',isset($data['name'])?$data['name']:"",
                ['placeholder'=>'Nama','class'=>'form-control',
                'required','autocomplete'=>'off']
                )}}
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="button" id="submitForm" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
    </div>
</div>
<script>
    var theForm = $("#theForm");
    $("#submitForm").click(function(){
        var statusForm = checkForm("theForm");
        if(statusForm==1){
            alert("Tolong isi form yang benar");
            return false;
        }
        theForm.submit();
    })
</script>