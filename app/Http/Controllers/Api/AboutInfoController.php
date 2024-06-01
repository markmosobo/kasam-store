<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutInfo;

class AboutInfoController extends Controller
{
    public function single(Request $request, $id)
    {
        $about = AboutInfo::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "success",
            'aboutinfo' => $about
        ], 200);
    }

    public function update(Request $request, $id)
    {
         $about = AboutInfo::findOrFail($id);
         $about->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "success",
            'aboutinfo' => $about
        ], 200);
    }
}
