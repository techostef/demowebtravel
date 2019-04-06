<div class="card">
    <div class="card-header">
        <strong><?php 
            echo empty($userData)?"Tambah":(isset($view)&&$view==true)?"View":"Update";
            ?> 
            Karyawan</strong>
    </div>

    <div class="card-body card-block">
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="text-input" class=" form-control-label">Nama <span style="color:red">*</span></label>
            </div>
            @if(isset($id_select))
            <input type="hidden" name='id' value="{{$id_select}}">
            @endif
            <div class="col-12 col-md-9">
                <?php 
                    $nama = '';
                    if(isset($userData['name'])){
                        $nama = $userData['name'];
                    }
                ?>
                {{Form::text('name',$nama,
                ['placeholder'=>'Nama','class'=>'form-control','required','autocomplete'=>'off']
                )}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="selectLg" class=" form-control-label">Level Karyawan <span style="color:red">*</span></label>
            </div>
            <div class="col-12 col-md-9">
                @if(isset($view))
                    <label>@if(isset($userData['name_user_level'])) {{$userData['name_user_level']}}@endif</label>
                @else
                    <select name='user_level' required class="combobox form-control">
                        <option value="">Level Karyawan</option>
                        @if(isset($user_level)&&is_array($user_level))
                            @foreach ($user_level as $r3)
                                <option value="{{Secure::encode($r3['id'])}}" 
                                @if(isset($userData['user_level'])&&$r3['id']==$userData['user_level'])
                                    selected
                                @endif
                                >{{$r3['name']}}</option>
                            @endforeach
                        @endif
                    </select>
                @endif
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="username" class="form-control-label">Username <span style="color:red">*</span></label>
            </div>
            <div class="col-12 col-md-9">
                <?php 
                    $username = '';
                    if(isset($userData['username'])){
                        $username = $userData['username'];
                    }
                ?>
                {{AjaxCheck::alert(
                    'username',
                    'focusout',
                    config('app.url').'/user/checkusername',
                    'Tolong ganti username, username telah dipakai',
                    ['i'=>'$("#username").val()'],
                    ['name'=>'username','placeholder'=>'Username','required'=>'required',
                    'class'=>'form-control','autocomplete'=>'off','value'=>$username]
                )}}
                {{-- {{Form::text('username',UserApp::viewdata('username'),
                ['placeholder'=>'Username','class'=>'form-control','autocomplete'=>'off']
                )}} --}}
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class=" form-control-label">Password 
                    @if(empty($userData))
                    <span style="color:red">*</span>
                    @endif
                </label>
            </div>
            <div class="col-12 col-md-9">
                <input 
                <?php 
                echo empty($userData)?"required":"";
                ?>
                type="password" id="password1" name="password" placeholder="Password" class="form-control">
                <small style="display:none" class="help-block form-text">Isi Password ketika ingin mengganti password</small>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class=" form-control-label">Verikasi Password 
                    @if(empty($userData))
                    <span style="color:red">*</span>
                    @endif
                </label>
            </div>
            <div class="col-12 col-md-9">
                <input 
                <?php 
                echo empty($userData)?"required":"";
                ?>
                type="password" name='password2' id="password2" placeholder="Verifikasi Password" class="form-control">
                <small id='verPassword' style="display:none" class="help-block form-text">Verifikasi password agar password sama</small>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label for="alamat" class="form-control-label">Alamat</label>
            </div>
            <div class="col-12 col-md-9">
                <?php 
                    $alamat = '';
                    if(isset($userData['address'])){
                        $alamat = $userData['address'];
                    }
                ?>
                <textarea name="address" id="alamat" rows="9" placeholder="" class="form-control">{{$alamat}}</textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label class="form-control-label">Foto</label>
            </div>
            <div class="col-12 col-md-9">
                <label for="foto" class="btn btn-info"><i class="menu-icon fa fa-image"></i></label>
                <input type="file" id="foto" name="foto" style="display:none" class="form-control-file">
            </div>
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
            </div>
            <div class="col-12 col-md-9">
                <?php 
                $url = config('app.url').'/images/avatar.png';
                if(isset($userData['foto'])&&$userData['foto']!=''){
                    $file = $userData['foto'];
                    $replace = UserApp::getnamefoto($userData['foto']);
                    $file = str_replace($replace,rawurlencode($replace),$file);
                    $file_headers = @get_headers($file);
                    if($file_headers[0] == 'HTTP/1.1 200 OK') {
                        $url = $file;
                    }
                }
                ?>
                <img style="width:200px;" id="containerfoto" src="{{$url}}">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
    </div>
</div>
<script>
   $('.combobox').combobox();
</script>
@if(isset($view)&&$view==true)
<script>
setTimeout(function(){
    toView("theForm");
    disableInput("theForm");
},0)
</script>
@endif
