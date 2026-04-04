<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\SalesItem;
class HomeController extends Controller
{
    public function index(){
    $today = Carbon::today();
    $month = Carbon::now()->month;
    $year= Carbon::now()->year;

    $dailySales = Sale::whereDate('created_at', $today)->sum('total_amount');
  
    $dailyPurchases = PurchaseItem::whereDate('created_at', $today)->sum(DB::raw('quantity * unit_price'));
    
    $dailyprofit = SalesItem::whereDate('created_at', $today)
    ->with('medicine')
    ->get()
    ->sum(function($item){
        return ($item->medicine->sell_price - $item->medicine->buy_price)  * $item->quantity;
    });

    $monthlySales = Sale::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('total_amount');
    $monthlyPurchases = PurchaseItem::whereMonth('created_at', $month)->whereYear('created_at',$year)->sum(DB::raw('quantity * unit_price'));
    $monthlyprofit = SalesItem::whereMonth('created_at', $month)
    ->with('medicine')
    ->get()
    ->sum(function($item){
        return ($item->medicine->sell_price - $item->medicine->buy_price)  * $item->quantity;
    });

    $currentWeekSales = Sale::whereBetween('created_at', [
    Carbon::now()->startOfWeek(),
    Carbon::now()->endOfWeek()
    ])->sum('total_amount');

    $lastWeekSales = Sale::whereBetween('created_at', [
    Carbon::now()->subWeek()->startOfWeek(),
    Carbon::now()->subWeek()->endOfWeek()
    ])->sum('total_amount');
    $currentMonthSales = Sale::whereMonth('created_at', Carbon::now()->month)
    ->whereYear('created_at', Carbon::now()->year)
    ->sum('total_amount');


    $lastMonthSales = Sale::whereMonth('created_at', Carbon::now()->subMonth()->month)
    ->whereYear('created_at', Carbon::now()->subMonth()->year)
    ->sum('total_amount');

    $weeklyChange = 0;

    if($lastWeekSales > 0){
    $weeklyChange = (($currentWeekSales - $lastWeekSales) / $lastWeekSales) * 100;
    }

    return view('admin.index', compact('dailySales', 'dailyPurchases', 'dailyprofit', 'monthlySales', 'monthlyPurchases', 'monthlyprofit', 'weeklyChange', 'currentWeekSales', 'lastWeekSales', 'currentMonthSales', 'lastMonthSales'));
    
    }
}
