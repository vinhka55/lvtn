<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Socialite;
use App\Models\User;
use App\Models\Cart as C;
use Session;
use DB;
use Cart;
use App\Rules\CaptchaRegister;
use App\Events\InboxPusherEvent;
use Toastr;

class LoginController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->with(["prompt" => "select_account"])->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = User::where('id',$authUser->login_id)->first();
        Session::put('name_user',$account_name->name);
        Session::put('user_id',$account_name->id);

        //Thông báo chào mừng thành viên mới
        event(new InboxPusherEvent("Chào mừng <b>".Session::get('name_user')."</b> Hãy mua sắm ngay nào."));

        return redirect('/');
        
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
            return $authUser;
        }
    
        $account = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = User::where('email',$users->email)->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $users->name,
                    'email' => $users->email,
                    'password' => '',
                    'phone' => '',
                ]);
            }
        $account->login()->associate($orang);
        $account->save();

        $account_name = User::where('id',$authUser->login_id)->first();
        Session::put('name_user',$account_name->name);
        Session::put('user_id',$account_name->id);
        return redirect('/');
    }
    public function login()
    {
        return view('page.login.login_user');
    }
    public function handle_login(Request $req)
    {
        $this->validate($req,[
            'email'=>"required|email",
            'password'=>"required",
        ]);
        $data=DB::table('user')->where('email',$req->email)->where('password',$req->password)->get();
        if(count($data)!=0){
                foreach($data as $item){
                Session::put('user_id',$item->id);
                Session::put('name_user',$item->name);
                Toastr::success('Đăng nhập thành công', 'Thành công');
                return redirect('/');
                }
        }else{
            echo 'sai pass or mail';
        }   
    }
    public function logout()
    {
        $cart=json_encode(Cart::items()->original);
        if(C::where('user_id',Session::get('user_id'))->first()){
            $save_cart=C::where('user_id',Session::get('user_id'))->first();
            $save_cart->values_cart=$cart;
            $save_cart->save();
        }
        else{
            $save_cart=new C();
            $save_cart->values_cart=$cart;
            $save_cart->user_id=Session::get('user_id');
            $save_cart->save();
        }
        
        Session::flush();
        return redirect('/');
    }
    public function register(Request $req)
    {
        $data=$req->validate([
            'name'=>"required",
            'email'=>"required|email",
            'password'=>'min:6|required|same:repassword',
            'repassword'=>'min:6',
            'phone'=>"required",
            'g-recaptcha-response'=>'required',
        ]);
        $new_user=[];
        $new_user['name']=$req->name;
        $new_user['email']=$req->email;
        $new_user['password']=$req->password;
        $new_user['phone']=$req->phone;
        $new_user['ip_address']=$req->ip();
        $user_id=DB::table('user')->insertGetId($new_user);
        Session::put('user_id',$user_id);
        Session::put('name_user',$req->name);

        //Thông báo chào mừng thành viên mới
        event(new InboxPusherEvent("Chào mừng <b>".Session::get('name_user')."</b> đã đăng kí thành công. Hãy mua sắm ngay nào."));
        return redirect('/');
    }
}
