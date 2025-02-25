<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('cap-nhat-don-hang','App\Http\Controllers\PaymentOnlineController@update_order')->name('update_order');
Route::get('/revenue', function (Request $request) {
    $range = $request->query('range', 'monthly');

    $data = [
        'daily' => [
            'labels' => array_map(fn($d) => "Ngày $d", range(1, now()->daysInMonth)),
            'data' => array_map(fn() => rand(500000, 10000000), range(1, now()->daysInMonth))
        ],
        'weekly' => [
            'labels' => ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            'data' => [5000000, 7000000, 8000000, 6000000]
        ],
        'monthly' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [12000000, 15000000, 18000000, 20000000, 17000000, 22000000, 25000000, 23000000, 21000000, 24000000, 26000000, 28000000]
        ],
        'yearly' => [
            'labels' => ['2020', '2021', '2022', '2023', '2024'],
            'data' => [150000000, 180000000, 200000000, 220000000, 250000000]
        ]
    ];

    return response()->json($data[$range] ?? $data['monthly']);
});

