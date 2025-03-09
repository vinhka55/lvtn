<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Feeship;

class ShippingController extends Controller
{
    public function choose_address(Request $request)
    {
        $district = DB::table('devvn_quanhuyen')->where('matp',$request->matp)->get();
        $output='';
        foreach ($district as $key => $value) {
            $output .= '<option class="item-district" value="'.$value->maqh.'">'.$value->name.'</option>';
        }
        return $output;
    }
    public function choose_ward(Request $request)
    {
        $ward = DB::table('devvn_xaphuongthitran')->where('maqh',$request->maqh)->get();
        $output='';
        foreach ($ward as $key => $value) {
            $output .= '<option class="item-ward" value="'.$value->xaid.'">'.$value->name.'</option>';
        }
        return $output;
    }   

    //trong admin 
    function list_fee_ship(){
        return view('admin.fee_ship.list');
    }

    // Thêm phí ship vào database
    public function addFeeShip(Request $request)
    {
        $data = [
            'matp' => $request->matp,
            'maqh' => $request->maqh,
            'xaid' => $request->xaid,
            'money' => $request->money
        ];
        DB::table('feeship')->insert($data);

        return response()->json(['message' => 'Thêm phí ship thành công!'], 200);
    }

    public function getFeeship()
    {
        $feeships = Feeship::with(['city', 'province', 'wards'])->get();
        return response()->json($feeships->map(function ($fee) {
            return [
                'id' => $fee->id,
                'tinh_name' => $fee->city ? $fee->city->name : 'Null',
                'huyen_name' => $fee->province ? $fee->province->name : 'Null',
                'xa_name' => $fee->wards ? $fee->wards->name : 'Null',
                'money' => $fee->money
            ];
        }));
    }
    function getFeeshipByCity($cityId) {
        $feeships = Feeship::with(['city', 'province', 'wards'])->where('matp',$cityId)->get();
        return response()->json($feeships->map(function ($fee) {
            return [
                'id' => $fee->id,
                'tinh_name' => $fee->city ? $fee->city->name : 'Null',
                'huyen_name' => $fee->province ? $fee->province->name : 'Null',
                'xa_name' => $fee->wards ? $fee->wards->name : 'Null',
                'money' => $fee->money
            ];
        }));
    }
   
    function updateFeeship(Request $request){
    
        $feeship = FeeShip::find($request->id);
        $feeship->money = $request->money;
        $feeship->save();

        return response()->json(['message' => 'Cập nhật phí ship thành công!']);
    }
    function countFeeship(Request $request){
        $fee = FeeShip::where([
            ['matp', $request->city_id],
            ['maqh', $request->district_id],
            ['xaid', $request->ward_id]
        ])->first();
    
        if ($fee) {
            return response()->json(['success' => true, 'fee' => $fee->money]);
        } else {
            return response()->json(['success' => true, 'fee' => 0]);
        }
    }
}
