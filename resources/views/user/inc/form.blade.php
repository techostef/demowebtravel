<div class="card">
    {!!Form::open([
        'action'=>'user\UserController@updateprofileku','method'=>'POST',
        'id'=>'theForm','enctype'=>"multipart/form-data",
        'class'=>'form-horizontal'
    ])!!}
    <div class="card-header">
        <strong>Profile Update</strong>
    </div>

    <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Nama</label>
            </div>
            <div class="col-12 col-md-9">
                {{Form::text('nama',UserApp::viewdata('name'),
                ['placeholder'=>'Nama','class'=>'form-control','autocomplete'=>'off']
                )}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="username" class="form-control-label">Username</label>
            </div>
            <div class="col-12 col-md-9">
                {{AjaxCheck::alert(
                    'username',
                    'focusout',
                    config('app.url').'/user/checkusername',
                    'Tolong ganti username, username telah dipakai',
                    ['i'=>'$("#username").val()'],
                    ['name'=>'username','placeholder'=>'Username','class'=>'form-control','autocomplete'=>'off','value'=>UserApp::viewdata('username')]
                )}}
                {{-- {{Form::text('username',UserApp::viewdata('username'),
                ['placeholder'=>'Username','class'=>'form-control','autocomplete'=>'off']
                )}} --}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class=" form-control-label">Password</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="password" id="password1" name="password" placeholder="Password" class="form-control">
                <small class="help-block form-text">Isi Password ketika ingin mengganti password</small>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class=" form-control-label">Verikasi Password</label>
            </div>
            <div class="col-12 col-md-9">
                <input type="password" id="password2" placeholder="Verifikasi Password" class="form-control">
                <small id='verPassword' name='password2' class="help-block form-text">Verifikasi password agar password sama</small>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="alamat" class="form-control-label">Alamat</label>
            </div>
            <div class="col-12 col-md-9">
                <textarea name="alamat" id="alamat" rows="9" placeholder="" class="form-control">{{UserApp::viewdata('address')}}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class="form-control-label">Foto</label>
            </div>
            <div class="col-12 col-md-9">
                <label for="foto" class="btn btn-info"><i class="menu-icon fa fa-image"></i></label>
                <input type="hidden" name="imgurl" value="{{UserApp::viewdata('foto')}}">
                <input type="file" id="foto" name="foto" style="display:none" class="form-control-file">
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
            </div>
            <div class="col-12 col-md-9">
                <img style="width:200px;" id="containerfoto" src="{{UserApp::fotourl()}}">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
    </div>
    </form>
</div>
