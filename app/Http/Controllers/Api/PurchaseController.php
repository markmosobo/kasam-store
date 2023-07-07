<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Activity;
use App\Models\ProductActivity;
use App\Models\User;
use App\Http\Resources\PurchaseResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();
        return PurchaseResource::collection($purchases);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = Purchase::create([
            'product_id' => $request->product_id,
            'pieces' => $request->pieces,
            'amount_payable' => $request->amount_payable,
            'amount_paid' => $request->amount_paid,
            'payment_type' => $request->payment_type,
            'mpesa_code' => $request->mpesa_code,
            'comments' => $request->comments,
            'created_by' => $request->created_by
        ]);
        //record activity
        Activity::create([
            'description' => 'sold an existing product',
            'created_by' => $request->created_by,
            'status' => 5
        ]);

        //record product history
        ProductActivity::create([
            'description' => $request->pieces .' pieces sold',
            'product_id' => $request->product_id,
            'created_by' => $request->created_by,
            'status' => 5
        ]);

        return response()->json([
            'status' => true,
            'message' => "Purchase Created successfully!",
            'purchase' => $purchase
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function myPurchases(Request $request, $id)
    {
        $mytodaypurchases = Purchase::where('created_by',$id)->with('product','user')->whereDay('created_at', now()->day)->get();
        $myyesterdaypurchases = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->get();
        $mytwentyfourpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->get();
        $mylastsevenpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $mymonthpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereMonth('created_at', Carbon::now()->month)->get();
        $mylastmonthpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $mylastninetypurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $myyearpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $myquarterlypurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $mylastyearpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $mysales = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->get();

        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'mytodaypurchases' => $mytodaypurchases,
            'myyesterdaypurchases' => $myyesterdaypurchases,
            'mytwentyfourpurchases' => $mytwentyfourpurchases,
            'mylastsevenpurchases' => $mylastsevenpurchases,
            'mymonthpurchases' => $mymonthpurchases,
            'mylastmonthpurchases' => $mylastmonthpurchases,
            'mylastninetypurchases' => $mylastninetypurchases,
            'myyearpurchases' => $myyearpurchases,
            'mylastyearpurchases' =>$mylastyearpurchases,
            'myquarterlypurchases' =>$myquarterlypurchases,
            'mysales' => $mysales
            ]
        ]);
    }

    public function myRevenue(Request $request, $id)
    {
        $mytodayrevenue = Purchase::where('created_by',$id)->whereDay('created_at', now()->day)->sum('amount_paid');
        $myyesterdayrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_paid');
        $mytwentyfourrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_paid');
        $mylastsevenrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $myweekrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_paid');
        $mylastthirtyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $mymonthrevenue = Purchase::where('created_by',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_paid');
        $mylastmonthrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_paid');
        $mylastninetyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $myyearrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_paid');
        $myquarterlyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $mylastyearrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_paid');
        $myrevenue = Purchase::where('created_by',$id)->with('product','user')->sum('amount_paid');

        $mytodayprojectedrevenue = Purchase::where('created_by',$id)->whereDay('created_at', now()->day)->sum('amount_payable');
        $myyesterdayprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_payable');
        $mytwentyfourprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_payable');
        $mylastsevenprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $myweekprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_payable');
        $mylastthirtyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $mymonthprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_payable');
        $mylastmonthprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_payable');
        $mylastninetyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $myyearprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_payable');
        $myquarterlyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $mylastyearprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_payable');
        $myprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->sum('amount_payable');


        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'mytodayrevenue' => $mytodayrevenue,
            'myyesterdayrevenue' => $myyesterdayrevenue,
            'mytwentyfourrevenue' => $mytwentyfourrevenue,
            'mylastsevenrevenue' => $mylastsevenrevenue,
            'myweekrevenue' => $myweekrevenue,
            'mylastthirtyrevenue' => $mylastthirtyrevenue,
            'mymonthrevenue' => $mymonthrevenue,
            'mylastmonthrevenue' => $mylastmonthrevenue,
            'mylastninetyrevenue' => $mylastninetyrevenue,
            'myyearrevenue' => $myyearrevenue,
            'myquarterlyrevenue' => $myquarterlyrevenue,
            'mylastyearrevenue' => $mylastyearrevenue,
            'myrevenue' => $myrevenue,
            'mytodayprojectedrevenue' => $mytodayprojectedrevenue,
            'myyesterdayprojectedrevenue' => $myyesterdayprojectedrevenue,
            'mytwentyfourprojectedrevenue' => $mytwentyfourprojectedrevenue,
            'mylastsevenprojectedrevenue' => $mylastsevenprojectedrevenue,
            'myweekprojectedrevenue' => $myweekprojectedrevenue,
            'mylastthirtyprojectedrevenue' => $mylastthirtyprojectedrevenue,
            'mymonthprojectedrevenue' => $mymonthprojectedrevenue,
            'mylastmonthprojectedrevenue' => $mylastmonthprojectedrevenue,
            'mylastninetyprojectedrevenue' => $mylastninetyprojectedrevenue,
            'myyearprojectedrevenue' => $myyearprojectedrevenue,
            'myquarterlyprojectedrevenue' => $myquarterlyprojectedrevenue,
            'mylastyearprojectedrevenue' => $mylastyearprojectedrevenue,
            'myprojectedrevenue' => $myprojectedrevenue
            ]
        ]);
    }

    public function userPurchases(Request $request, $id)
    {
        // $user = Auth::user(); 
        $usertodaypurchases = Purchase::where('created_by',$id)->with('product','user')->whereDay('created_at', now()->day)->get();
        $useryesterdaypurchases = Purchase::where('created_by',$id)->select("*")->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->get();
        $usertwentyfourpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->get();
        $userlastsevenpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $usermonthpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereMonth('created_at', Carbon::now()->month)->get();
        $userlastmonthpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $userlastninetypurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $useryearpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $userquarterlypurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $userlastyearpurchases = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $usersales = Purchase::where('created_by',$id)->with('product','user')->orderByDesc('created_at')->get();
        
        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'usertodaypurchases' => $usertodaypurchases,
            'useryesterdaypurchases' => $useryesterdaypurchases,
            'usertwentyfourpurchases' => $usertwentyfourpurchases,
            'userlastsevenpurchases' => $userlastsevenpurchases,
            'usermonthpurchases' => $usermonthpurchases,
            'userlastmonthpurchases' => $userlastmonthpurchases,
            'userlastninetypurchases' => $userlastninetypurchases,
            'useryearpurchases' => $useryearpurchases,
            'userlastyearpurchases' =>$userlastyearpurchases,
            'userquarterlypurchases' =>$userquarterlypurchases,
            'usersales' => $usersales
            ]
        ]);
    }

    public function userRevenue(Request $request, $id)
    {
        $usertodayrevenue = Purchase::where('created_by',$id)->whereDay('created_at', now()->day)->sum('amount_paid');
        $useryesterdayrevenue = Purchase::select("*")->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_paid');
        $usertwentyfourrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_paid');
        $userlastsevenrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $userweekrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_paid');
        $userlastthirtyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $usermonthrevenue = Purchase::where('created_by',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_paid');
        $userlastmonthrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_paid');
        $userlastninetyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $useryearrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_paid');
        $userquarterlyrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $userlastyearrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_paid');
        $userrevenue = Purchase::where('created_by',$id)->with('product','user')->sum('amount_paid');

        $usertodayprojectedrevenue = Purchase::where('created_by',$id)->whereDay('created_at', now()->day)->sum('amount_payable');
        $useryesterdayprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_payable');
        $usertwentyfourprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_payable');
        $userlastsevenprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $userweekprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_payable');
        $userlastthirtyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $usermonthprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_payable');
        $userlastmonthprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_payable');
        $userlastninetyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $useryearprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_payable');
        $userquarterlyprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $userlastyearprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_payable');
        $userprojectedrevenue = Purchase::where('created_by',$id)->with('product','user')->sum('amount_payable');

        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'usertodayrevenue' => $usertodayrevenue,
            'useryesterdayrevenue' => $useryesterdayrevenue,
            'usertwentyfourrevenue' => $usertwentyfourrevenue,
            'userlastsevenrevenue' => $userlastsevenrevenue,
            'userweekrevenue' => $userweekrevenue,
            'userlastthirtyrevenue' => $userlastthirtyrevenue,
            'usermonthrevenue' => $usermonthrevenue,
            'userlastmonthrevenue' => $userlastmonthrevenue,
            'userlastninetyrevenue' => $userlastninetyrevenue,
            'useryearrevenue' => $useryearrevenue,
            'userquarterlyrevenue' => $userquarterlyrevenue,
            'userlastyearrevenue' => $userlastyearrevenue,
            'userrevenue' => $userrevenue,
            'usertodayprojectedrevenue' => $usertodayprojectedrevenue,
            'useryesterdayprojectedrevenue' => $useryesterdayprojectedrevenue,
            'usertwentyfourprojectedrevenue' => $usertwentyfourprojectedrevenue,
            'userlastsevenprojectedrevenue' => $userlastsevenprojectedrevenue,
            'userweekprojectedrevenue' => $userweekprojectedrevenue,
            'userlastthirtyprojectedrevenue' => $userlastthirtyprojectedrevenue,
            'usermonthprojectedrevenue' => $usermonthprojectedrevenue,
            'userlastmonthprojectedrevenue' => $userlastmonthprojectedrevenue,
            'userlastninetyprojectedrevenue' => $userlastninetyprojectedrevenue,
            'useryearprojectedrevenue' => $useryearprojectedrevenue,
            'userquarterlyprojectedrevenue' => $userquarterlyprojectedrevenue,
            'userlastyearprojectedrevenue' => $userlastyearprojectedrevenue,
            'userprojectedrevenue' => $userprojectedrevenue
            ]
        ]);
    }

    public function productSales(Request $request, $id)
    {
        // $user = Auth::user(); 
        $todaysales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereDay('created_at', now()->day)->get();
        $yesterdaysales = Purchase::where('product_id',$id)->select("*")->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->get();
        $twentyfoursales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->get();
        $lastsevensales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $weeksales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $lastthirtysales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $monthsales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereMonth('created_at', Carbon::now()->month)->get();
        $lastmonthsales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $lastninetysales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $yearsales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $quarterlysales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $lastyearsales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $allsales = Purchase::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->get();

        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'yesterdaysales' => $yesterdaysales,
            'todaysales' => $todaysales,
            'twentyfoursales' => $twentyfoursales,
            'lastsevensales' => $lastsevensales,
            'weeksales' => $weeksales,
            'lastthirtysales' => $lastthirtysales,
            'monthsales' => $monthsales,
            'lastmonthsales' => $lastmonthsales,
            'lastninetysales' => $lastninetysales,
            'yearsales' => $yearsales,
            'quarterlysales' => $quarterlysales,
            'lastyearsales' => $lastyearsales,
            'allsales' => $allsales
            ]
        ]);
    }

    public function productRevenue(Request $request, $id)
    {
        $todayrevenue = Purchase::where('product_id',$id)->whereDay('created_at', now()->day)->sum('amount_paid');
        $yesterdayrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_paid');
        $twentyfourrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_paid');
        $lastsevenrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $weekrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_paid');
        $lastthirtyrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $monthrevenue = Purchase::where('product_id',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_paid');
        $lastmonthrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_paid');
        $lastninetyrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $yearrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_paid');
        $quarterlyrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_paid');
        $lastyearrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_paid');
        $allrevenue = Purchase::where('product_id',$id)->with('product','user')->sum('amount_paid');
        
        $todayprojectedrevenue = Purchase::where('product_id',$id)->whereDay('created_at', now()->day)->sum('amount_payable');
        $yesterdayprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->sum('amount_payable');
        $twentyfourprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subHours(24), Carbon::now()->endOfDay()])->sum('amount_payable');
        $lastsevenprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $weekprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount_payable');
        $lastthirtyprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(29)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $monthprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereMonth('created_at', Carbon::now()->month)->sum('amount_payable');
        $lastmonthprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->sum('amount_payable');
        $lastninetyprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $yearprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount_payable');
        $quarterlyprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->sum('amount_payable');
        $lastyearprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->sum('amount_payable');
        $allprojectedrevenue = Purchase::where('product_id',$id)->with('product','user')->sum('amount_payable');
            

        return response()->json([
            "lists" => [
            'status' => 200,
            'message' => 'success',
            'todayrevenue' => $todayrevenue,
            'yesterdayrevenue' => $yesterdayrevenue,
            'twentyfourrevenue' => $twentyfourrevenue,
            'lastsevenrevenue' => $lastsevenrevenue,
            'weekrevenue' => $weekrevenue,
            'lastthirtyrevenue' => $lastthirtyrevenue,
            'monthrevenue' => $monthrevenue,
            'lastmonthrevenue' => $lastmonthrevenue,
            'lastninetyrevenue' => $lastninetyrevenue,
            'yearrevenue' => $yearrevenue,
            'quarterlyrevenue' => $quarterlyrevenue,
            'lastyearrevenue' => $lastyearrevenue,
            'allrevenue' => $allrevenue,
            'todayprojectedrevenue' => $todayprojectedrevenue,
            'yesterdayprojectedrevenue' => $yesterdayprojectedrevenue,
            'twentyfourprojectedrevenue' => $twentyfourprojectedrevenue,
            'lastsevenprojectedrevenue' => $lastsevenprojectedrevenue,
            'weekprojectedrevenue' => $weekprojectedrevenue,
            'lastthirtyprojectedrevenue' => $lastthirtyprojectedrevenue,
            'monthprojectedrevenue' => $monthprojectedrevenue,
            'lastmonthprojectedrevenue' => $lastmonthprojectedrevenue,
            'lastninetyprojectedrevenue' => $lastninetyprojectedrevenue,
            'yearprojectedrevenue' => $yearprojectedrevenue,
            'quarterlyprojectedrevenue' => $quarterlyprojectedrevenue,
            'lastyearprojectedrevenue' => $lastyearprojectedrevenue,
            'allprojectedrevenue' => $allprojectedrevenue
            ]
        ]);
    }
}
