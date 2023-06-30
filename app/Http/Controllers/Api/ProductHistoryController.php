<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductActivity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductHistoryController extends Controller
{
    public function index(Request $request, $id)
    {
        $recenthistory = ProductActivity::with('product','user')->where('product_id',$id)->whereDay('created_at', now()->day)->orderByDesc('created_at')->take(6)->get();
        $todayhistory = ProductActivity::with('product','user')->where('product_id',$id)->whereDay('created_at', now()->day)->orderByDesc('created_at')->get();
        $twentyfourhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->get();
        $yesterdayhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->get();
        $lastsevenhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $weekhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $lastthirtyhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $monthhistory = ProductActivity::with('product','user')->orderByDesc('created_at')->whereMonth('created_at', Carbon::now()->month)->get();
        $lastmonthhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $lastninetyhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $yearhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $lastyearhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $quarterlyhistory = ProductActivity::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $allhistory = ProductActivity::where('product_id',$id)->with('product','user')->get();


        return response()->json([
            "lists" => [
                "recenthistory" => $recenthistory,
                "todayhistory" => $todayhistory,
                "twentyfourhistory" => $twentyfourhistory,
                "yesterdayhistory" => $yesterdayhistory,
                "lastsevenhistory" => $lastsevenhistory,
                "weekhistory" => $weekhistory,
                "lastthirtyhistory" => $lastthirtyhistory,
                "monthhistory" => $monthhistory,
                "lastninetyhistory" => $lastninetyhistory,
                "lastmonthhistory" => $lastmonthhistory,
                "yearhistory" => $yearhistory,
                "lastyearhistory" => $lastyearhistory,
                "quarterlyhistory" => $quarterlyhistory,
                "allhistory" => $allhistory
            ]
        ]);
    }
}
