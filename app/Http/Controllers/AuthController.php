<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Auth;

class AuthController extends Controller
{

    public function register_auth()
    {
        return view('admin.auth.register');
    }
    public function handle_register(Request $req)
    {
        $this->validation($req);
        $data=$req->all();
        $user=new Admin();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=md5($data['password']);
        $user->phone=$data['phone'];
        $user->save();
        
        return redirect('/admin/login')->with('message','Đăng kí thành công, login ngay nào');
    }
    public function login()
    {
        return view('admin.auth.login');
    }
    public function handle_login(Request $req)
    {
        $this->validate($req,[
            'email'=>'required|email|max:50',
            'password'=>'required|max:50',
        ]);
        $data=$req->all();

        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('/admin');
        }
        else{
            return redirect('admin/login')->with('message','Sai email hoặc mật khẩu');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
    public function validation($req)
    {
        return $req->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'password'=>'min:6|required|same:repassword',
            'repassword'=>'min:6',
            'phone'=>'required|min:10',
        ]);
    }
}
