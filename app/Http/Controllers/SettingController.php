<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Session;
use Toastr;

class SettingController extends Controller
{
    function index(){
        $information = Setting::all();
        return view('admin.setting.information')->with(compact('information'));
    }
    
    function handle(Request $req){
        $information = Setting::find(1);
        $information->name = $req->name;
        $information->email = $req->email;
        $information->phone = $req->phone;
        $information->address = $req->address;
        $information->tax = $req->tax;
        $information->logo = $req->file("logo");
        if($information->logo){
            $name_logo= $information->logo->getClientOriginalName();
            $information->logo->move("public/assets/img/logo",$name_logo);
            $information->logo=$name_logo;
            $information->save();
            Toastr::success('Sửa đổi thành công', 'Thành công');
            return redirect('admin/sua-thong-tin-doanh-nghiep');
        }
        $information->logo = $req->old_logo;
        $information->save();
        Toastr::success('Sửa đổi thành công', 'Thành công');
        return redirect('admin/sua-thong-tin-doanh-nghiep');
    }
}
