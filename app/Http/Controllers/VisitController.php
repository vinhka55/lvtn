<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitors;
use Carbon\Carbon;

class VisitController extends Controller {
    public function index() {
        $visits = Visitors::selectRaw('DATE(date_visitor) as date, SUM(count) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return response()->json($visits);
    }
}
