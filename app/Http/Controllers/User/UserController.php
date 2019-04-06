<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DSC;
use App\Http\Controllers\MD;
use App\Http\Controllers\Secure\Secure;
use DB;

class UserController extends Controller
{
    private $menu_user = Array(
        "list_daftar_karyawan",
        "lihat_daftar_karyawan",
        "tambah_daftar_karyawan",
        "ubah_daftar_karyawan",
        "history_daftar_karyawan",
        "hapus_daftar_karyawan",
        "list_restore_karyawan",
        "restore_restore_karyawan",
        "restore_delete_karyawan",
        "list_daftar_customer",
        "lihat_daftar_customer",
        "tambah_daftar_customer",
        "ubah_daftar_customer",
        "hapus_daftar_customer",
        "history_daftar_customer",
        "list_restore_customer",
        "restore_restore_customer",
        "restore_delete_customer",
        "list_daftar_transaction_order",
        "lihat_daftar_transaction_order",
        "tambah_daftar_transaction_order",
        "ubah_daftar_transaction_order",
        "hapus_daftar_transaction_order",
        "history_daftar_transaction_order",
        "list_restore_transaction_order",
        "restore_restore_transaction_order",
        "restore_delete_transaction_order",
    );

    public function profileku(){
        $user = DSC::getdata();
        $data = array('user'=>$user);
        return view('user.profileku')->with($data);
    }

    public function updateprofileku(Request $data){
        $user = DSC::getdata();
        $id_users = $user['id'];
        $this->validate($data,[
            'username'=>'required',
            'foto'=>'image|nullable|max:1999'
        ]);
        $filenametoStore = "";
        if($data->hasFile('foto')==true){
            $filenameWithExt = $data->file('foto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            $extension = $data->file('foto')->getClientOriginalExtension();

            $filenametoStore = $filename."_".time().".".$extension;

            $path = $data->file("foto")->storeAs("public/file/users/foto",$filenametoStore);
            $filenametoStore = "/storage/file/users/foto/".$filenametoStore;
        }

        $msg_err = "";
        $username = $data->input('nama');
        $result = DB::select("select count(id) as a from user where id!='$id_users' and username='$username'");
        $result = MD::row_array($result);
        if($result['a']==0){
            DB::table('user')->where('id',$id_users)->update([
                'name'=>$data->input('nama'),
                'username'=>$data->input('username'),
                'address'=>$data->input('alamat'),
            ]);
            if($data->input('password')!=''){
                DB::table('user')->where('id',$id_users)->update([
                    'password'=>md5($data->input('password')),
                ]);
            }
            if($filenametoStore!=''){
                DB::table('user')->where('id',$id_users)->update([
                    'foto'=>$filenametoStore,
                ]);
            }
            return redirect('/user/profileku')->with('success','Berhasil Mengupdate');

        }else{
            $msg_err = "Username sudah terdaftar tolong piih yang lain";
            return redirect('/user/profileku')->with('error',$msg_err);
        }
    }

    public function checkusername(Request $data){
        $user = DSC::getdata();
        $id_users = $user['id'];
        $username = $data->input('i');
        $result = DB::select("select count(id) as a from user where id!='$id_users' and username='$username'");
        $result = MD::row_array($result);
        if($result['a']>0){
            echo json_encode(false);
        }else{
            echo json_encode(true);
        }
    }

    public function karyawan(){
        $user = DSC::getdata();
        $level = $user['user_level'];
        $result = DB::select("select * from user where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );
        return view('user.karyawan')->with($data);
    }

    public function karyawan_restore(){
        $user = DSC::getdata();
        $level = $user['user_level'];
        $result = DB::select("select * from user where na='Y'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );
        return view('user.karyawan_restore')->with($data);
    }

    public function karyawan_level(){
        $user = DSC::getdata();
        $level = $user['user_level'];
        $result = DB::select("select * from user_level where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );
        return view('user.karyawan_level')->with($data);
    }

    public function karyawan_level_restore(){
        $user = DSC::getdata();
        $level = $user['user_level'];
        $result = DB::select("select * from user_level where na='Y'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'result'=>$result
        );
        return view('user.karyawan_level_restore')->with($data);
    }

    public function tambah(){
        $user = DSC::getdata();
        $role = $this->menu_user;
        $result = DB::select("select * from user_level where na='N'");
        $result = MD::result_array($result);
        $data = array(
            'user'=>$user,
            'user_level'=>$result,
            'role'=>$role,
        );
        return view('user.tambah')->with($data);
    }

    public function user_level_tambah(){
        $user = DSC::getdata();
        $role = $this->menu_user;
        $data = array(
            'user'=>$user,
            'role'=>$role,
        );
        return view('user.user_level')->with($data);
    }

    public function permission($id){
        $user = DSC::getdata();
        $role = $this->menu_user;
        $result = DB::select("select * from user_permission where id_user_level='".Secure::decode($id)."'");
        $result = MD::result_array($result);
        $data = array(
            'id'=>$id,
            'user'=>$user,
            'role'=>$role,
            'permission'=>$this->menu_user,
            'data'=>$result,
        );
        return view('user.permission')->with($data);
    }

    public function permission_update(Request $data){
        $id = $data->input('id');
        if(Secure::decode($id)==null){
            return redirect('/user/profilku')->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        $user = DSC::getdata();
        $list = $data->input('list');
        $access = $data->input('access');
        foreach($list as $row){
            $status = -1;
            $code = 0;
            $result = DB::select("select * from user_permission where name='$row' && id_user_level='$id'");
            $result = MD::row_array($result);
            if(count($result)>0){
                $status = $result['id'];
            }
            if(gettype(array_search($row,$access))=="integer"){
                $code = 1;
            }

            if($status==-1){
                $arr = [
                    'id_user_level'=>$id,
                    'name'=>$row,
                    'code'=>$code
                ];
                DB::table('user_permission')->insert($arr);
            }else{
                $arr = [
                    'code'=>$code
                ];
                DB::table('user_permission')->where('id',$status)->update($arr);

            }
        }

        // add history
        MD::history($user['name'],'user_level','change permission','id='.$id);

        return redirect('/user/karyawan_level')->with('success','Berhasil Mengupdate');
    }

    public function user_level_insertdata(Request $data){
        $user = DSC::getdata();

        $this->validate($data,[
            'nama'=>'required'
        ]);

        $arr = [
            'name'=>$data->input('nama'),
        ];

        $result = DB::select("select * from user_level where name='".$data->input('nama')."'");

        $result = MD::result_array($result);
        if(count($result)>0){
            return redirect('/user_level/tambah')->with('error','Name Sudah Terdaftar');
        }

        $id = DB::table('user_level')->insertGetId($arr);

        // add history
        MD::history($user['name'],'user_level','insert','id='.$id);

        return redirect('/user/karyawan_level')->with('success','Berhasil Menambahkan');

    }

    public function user_level_edit($id){
        if(Secure::decode($id)==null){
            return redirect('/user/profilku')->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        $user = DSC::getdata();
        $role = $this->menu_user;
        $result = DB::select("select * from user_level where na='N' and id='$id'");
        $result = MD::row_array($result);
        if(count($result)==0){
            return redirect('user/karyawan_level')->with("error","Karyawan Tidak Ditemukan");
        }
        $data = array(
            'user'=>$user,
            'role'=>$role,
            'data'=>$result,
        );
        return view('user.user_level')->with($data);
    }

    public function user_level_updatedata(Request $data){
        $user = DSC::getdata();
        $this->validate($data,[
            'nama'=>'required'
        ]);
        $arr = [
            'name'=>$data->input('nama'),
        ];
        $id = $data->input('id');
        if(Secure::decode($id)==null){
            return redirect('/user/karyawan')->with('error','Kesalahan keamanan,mencoba meretas keamanan');
        }
        $id = Secure::decode($id);

        $result = DB::select("select * from user_level where name='".$data->input('nama')."' and id!='$id' ");

        $result = MD::result_array($result);
        if(count($result)>0){
            return redirect('/user_level/edit/'.$data->input('id'))->with('error','Name Sudah Terdaftar');
        }

        DB::table('user_level')->where('id',$id)->update($arr);

        // add history
        MD::history($user['name'],'user_level','update','id='.$id);

        return redirect('/user/karyawan_level')->with('success','Berhasil Mengupdate');
    }

    public function user_level_delete($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/user/karyawan')->with('error','Kesalahan keamanan,mencoba meretas keamanan');
        }
        $id = Secure::decode($id);
        $arr = [
            'na'=>'Y'
        ];
        DB::table('user_level')->where('id',$id)->update($arr);
        
        // add history
        MD::history($user['name'],'user_level','delete','id='.$id);

        return redirect('/user/karyawan_level')->with('success','Berhasil Menghapus');
    }

    public function user_level_restore($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/user/karyawan')->with('error','Kesalahan keamanan,mencoba meretas keamanan');
        }
        $id = Secure::decode($id);
        $arr = [
            'na'=>'N'
        ];
        DB::table('user_level')->where('id',$id)->update($arr);
        
        // add history
        MD::history($user['name'],'user_level','restore','id='.$id);

        return redirect('/user/karyawan_level')->with('success','Berhasil Mengembalikan Data');
    }

    public function user_level_delete_permanent($id){
        $user = DSC::getdata();
        if(Secure::decode($id)==null){
            return redirect('/user/karyawan')->with('error','Tolong Coba Kembali');
        }
        $id = Secure::decode($id);
        
        DB::delete("delete from user_level where id='$id'");

        return redirect('/user/karyawan_level')->with('success','Berhasil Menghapus');
    }

    public function insertdata(Request $data){
        $this->validate($data,[
            'username'=>'required',
            'password'=>'required',
            'foto'=>'image|nullable|max:1999'
        ]);

        $user = DSC::getdata();
        $id_users = $user['id'];
        $this->validate($data,[
            'username'=>'required',
            'password'=>'required',
            'foto'=>'image|nullable|max:1999'
        ]);

        $result = DB::select("select * from user where username='".$data->input('username')."'");
        $result = MD::row_array($result);
        if(count($result)>0){
            return redirect('user/tambah')->with("error","Username sudah terdaftar");
        }
        if(Secure::decode($data->input('user_level'))==null){
            return redirect('/user/karyawan')->with('error',"Kesalahan keamanan,mencoba meretas keamanan");
        }
        $filenametoStore = '/images/avatar.png';
        if($data->hasFile('foto')){
            $filenameWithExt = $data->file('foto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            $extension = $data->file('foto')->getClientOriginalExtension();

            $filenametoStore = $filename."_".time().".".$extension;

            $path = $data->file("foto")->storeAs("public/file/users/foto",$filenametoStore);
            $filenametoStore = "/storage/file/users/foto/".$filenametoStore;
        }
        $menu = $data->input('menu');
        $arr = [
            'name'=>$data->input('name'),
            'username'=>$data->input('username'),
            'password'=>md5($data->input('password')),
            'address'=>$data->input('address'),
            'foto'=>$filenametoStore,
            'user_level'=>Secure::decode($data->input('user_level'))
        ];
        $id = DB::table('user')->insertGetId($arr);
        
        // add history
        MD::history($user['name'],'user','insert','id='.$id);

        return redirect('/user/karyawan')->with('success','Berhasil Menambahkan');

    }

    public function edit($id){
        if(Secure::decode($id)==null){
            return redirect('/home');
        }
        $userData = DSC::getdata(Secure::decode($id));
        $user = DSC::getdata();
        $role = $this->menu_user;
        $menu = '';
        $result = DB::select("select * from user_level where na='N'");
        $result = MD::result_array($result);
        
        $data = array(
            'userData'=>$userData,
            'user_level'=>$result,
            'user'=>$user,
            'id_select'=>$id,
            'role'=>$role,
            'menu'=>$menu,
        );
        return view('user.tambah')->with($data);
    }

    public function view($id){
        if(Secure::decode($id)==null){
            return redirect('/home');
        }
        $userData = DB::select("select user.*,user_level.name as name_user_level from user join user_level on user.user_level=user_level.id where user.id='".Secure::decode($id)."'");;
        $userData = MD::row_array($userData);
        $user = DSC::getdata();
        $role = $this->menu_user;
        $menu = '';
        $result = DB::select("select * from user_level where na='N'");
        $result = MD::result_array($result);
        
        $data = array(
            'userData'=>$userData,
            'user_level'=>$result,
            'user'=>$user,
            'id_select'=>$id,
            'role'=>$role,
            'menu'=>$menu,
            'view'=>true,
        );
        return view('user.tambah')->with($data);
    }

    public function updatedata(Request $data){
        
        $this->validate($data,[
            'username'=>'required',
            'foto'=>'image|nullable|max:1999'
        ]);
        
        $user = DSC::getdata();

        $id = $data->input('id');

        if(Secure::decode($id)==null){
            return redirect('/user/karyawan')->with('error','Kesalahan keamanan,mencoba meretas keamanan');
        }

        if(Secure::decode($data->input('user_level'))==null){
            return redirect('/user/karyawan')->with('error',"Kesalahan keamanan,mencoba meretas keamanan");
        }

        $id_users = Secure::decode($data->input('id'));

        $filenametoStore = '';
        if($data->hasFile('foto')){
            $filenameWithExt = $data->file('foto')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            $extension = $data->file('foto')->getClientOriginalExtension();

            $filenametoStore = $filename."_".time().".".$extension;

            $path = $data->file("foto")->storeAs("public/file/users/foto",$filenametoStore);
            $filenametoStore = config('app.url')."/storage/file/users/foto/".$filenametoStore;
        }

        $menu = $data->input('menu');

        $arr = [
            'name'=>$data->input('name'),
            'username'=>$data->input('username'),
            'address'=>$data->input('address'),
            'user_level'=>Secure::decode($data->input('user_level'))
        ];

        DB::table('user')->where('id',$id_users)->update($arr);
        
        if($data->input('password')!=''){
            DB::table('user')->where('id',$id_users)->update([
                'password'=>md5($data->input('password')),
            ]);
        }

        if($filenametoStore!=''){
            DB::table('user')->where('id',$id_users)->update([
                'foto'=>$filenametoStore,
            ]);
        }

        // add history
        file_put_contents("debug.txt",'id='.$id_users);

        MD::history($user['name'],'user','update','id='.$id_users);


        return redirect('/user/karyawan')->with('success','Berhasil Terupdate');
    }

    public function delete($id){
        if(Secure::decode($id)==null){
            return redirect('/user/profilku')->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        
        $user = DSC::getdata();

        $arr = [
            'na'=>"Y"
        ];

        DB::table('user')->where('id',$id)->update($arr);
        // DB::delete("delete from user where id='$id'");

        // add history
        MD::history($user['name'],'user','delete','id='.$id);

        return redirect('/user/karyawan')->with('error','Berhasil Menghapus Data');
    }

    public function restore($id){
        if(Secure::decode($id)==null){
            return redirect('/user/profilku')->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);
        
        $user = DSC::getdata();

        $arr = [
            'na'=>"N"
        ];

        DB::table('user')->where('id',$id)->update($arr);
        // DB::delete("delete from user where id='$id'");

        // add history
        MD::history($user['name'],'user','restore','id='.$id);

        return redirect('/user/karyawan')->with('success','Berhasil Mengembalikan Data');
    }

    public function delete_permanent($id){
        if(Secure::decode($id)==null){
            return redirect('/user/profilku')->with("error","Kesalahan keamanan,mencoba meretas keamanan");
        }
        $id = Secure::decode($id);

        DB::delete("delete from user where id='$id'");

        return redirect('/user/karyawan')->with('error','Berhasil Menghapus Data');
    }
}
