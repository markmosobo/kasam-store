<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxTot;

class TaxTotController extends Controller
{
    public function single(Request $request, $id)
    {
        $tax = TaxTot::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "success",
            'taxtot' => $tax
        ], 200);
    }

    public function update(Request $request, $id)
    {
         $tax = TaxTot::findOrFail($id);
         $tax->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "success",
            'tax' => $tax
        ], 200);
    }
}
