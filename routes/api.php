<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Visitors;
use App\Models\PostController;
use App\Http\Controllers\ShippingController;


Route::get('/tinhthanhpho', function () {
    return response()->json(DB::table('devvn_tinhthanhpho')->get());
});

Route::get('/quanhuyen/{matp}', function ($matp) {
    return response()->json(DB::table('devvn_quanhuyen')->where('matp', $matp)->get());
});

Route::get('/xaphuongthitran/{maqh}', function ($maqh) {
    return response()->json(DB::table('devvn_xaphuongthitran')->where('maqh', $maqh)->get());
});

Route::post('/feeship', 'App\Http\Controllers\ShippingController@addFeeShip')->name('addFeeShip');
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
    $validRanges = ['daily', 'monthly', 'yearly'];
    $range = in_array($request->query('range'), $validRanges) ? $request->query('range') : 'monthly';

    // Chỉ lấy đơn hàng có status là 'completed' hoặc 'paid_pending'
    $validStatuses = ['Đã xử lý', 'Đã thanh toán-chờ nhận hàng'];

    if ($range === 'daily') {
        $daysInMonth = now()->format('t');
        $revenues = Order::selectRaw('DAY(created_at) as day, SUM(total_money) as revenue')
            ->whereIn('status', $validStatuses)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->groupBy('day')
            ->pluck('revenue', 'day');

        $data = [
            'labels' => array_map(fn($d) => now()->startOfMonth()->addDays($d - 1)->format('d/m/Y'), range(1, now()->daysInMonth)),
            'data' => array_map(fn($d) => $revenues[$d] ?? 0, range(1, $daysInMonth))
        ];
    }

    elseif ($range === 'monthly') {
        $revenues = Order::selectRaw('MONTH(created_at) as month, SUM(total_money) as revenue')
            ->whereIn('status', $validStatuses)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('revenue', 'month');

        $data = [
            'labels' => array_map(fn($m) => now()->month($m)->format('m/Y'), range(1, 12)),
            'data' => array_map(fn($m) => $revenues[$m] ?? 0, range(1, 12))
        ];
    }

    elseif ($range === 'yearly') {
        $revenues = Order::selectRaw('YEAR(created_at) as year, SUM(total_money) as revenue')
            ->whereIn('status', $validStatuses)
            ->groupBy('year')
            ->pluck('revenue', 'year');

        $data = [
            'labels' => $revenues->keys()->map(fn($y) => "$y")->toArray(),
            'data' => $revenues->values()->toArray()
        ];
    }

    return response()->json($data);
});

Route::get('/visitor-stats', function (Request $request) {
    $range = $request->query('range', 'monthly');

    $statsQuery = Visitors::query();
    \Log::info('123');
    \Log::info($statsQuery);
    if ($range === 'daily') {
        $statsQuery->where('date_visitor', '>=', Carbon::now()->startOfMonth());
    } elseif ($range === 'weekly') {
        $statsQuery->where('date_visitor', '>=', Carbon::now()->subWeeks(4));
    } elseif ($range === 'yearly') {
        $statsQuery->where('date_visitor', '>=', Carbon::now()->subYears(5));
    }

    $stats = $statsQuery->orderBy('date_visitor')->get();

    return response()->json([
        'labels' => $stats->pluck('date_visitor'),
        'data' => $stats->pluck('visits')
    ]);
});

Route::get('/visits', function (Request $request) {
    $validRanges = ['daily', 'monthly', 'yearly'];
    $range = in_array($request->query('range'), $validRanges) ? $request->query('range') : 'monthly';

    if ($range === 'daily') {
        $daysInMonth = now()->format('t');
        $count_visit = Visitors::selectRaw('DAY(date_visitor) as day, SUM(count) as count_visit')
            ->whereMonth('date_visitor', now()->month)
            ->whereYear('date_visitor', now()->year)
            ->groupBy('day')
            ->pluck('count_visit', 'day');

        $data = [
            'labels' => array_map(fn($d) => now()->startOfMonth()->addDays($d - 1)->format('d/m/Y'), range(1, now()->daysInMonth)),
            'data' => array_map(fn($d) => $count_visit[$d] ?? 0, range(1, $daysInMonth))
        ];
    }

    elseif ($range === 'monthly') {
        $count_visit = Visitors::selectRaw('MONTH(date_visitor) as month, SUM(count) as count_visit')
            ->whereYear('date_visitor', now()->year)
            ->groupBy('month')
            ->pluck('count_visit', 'month');

        $data = [
            'labels' => array_map(fn($m) => now()->month($m)->format('m/Y'), range(1, 12)),
            'data' => array_map(fn($m) => $count_visit[$m] ?? 0, range(1, 12))
        ];
    }

    elseif ($range === 'yearly') {
        $count_visit = Visitors::selectRaw('YEAR(date_visitor) as year, SUM(count) as count_visit')
            ->groupBy('year')
            ->pluck('count_visit', 'year');

        $data = [
            'labels' => $count_visit->keys()->map(fn($y) => "$y")->toArray(),
            'data' => $count_visit->values()->toArray()
        ];
    }

    return response()->json($data);
});



