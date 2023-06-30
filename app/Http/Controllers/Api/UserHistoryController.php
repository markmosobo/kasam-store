<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class UserHistoryController extends Controller
{
    public function index(Request $request, $id)
    {
        $recenthistory = Activity::where('created_by',$id)->with('user')->whereDay('created_at', now()->day)->orderByDesc('created_at')->take(6)->get();
        return response()->json([
            "lists" => [
                "recenthistory" => $recenthistory,
                "id" => $id
            ]
        ]);
    }
}
