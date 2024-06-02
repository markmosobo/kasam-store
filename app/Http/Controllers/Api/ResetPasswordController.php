<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetPassword;

class ResetPasswordController extends Controller
{
    public function single(Request $request, $id)
    {
        $resetpassword = ResetPassword::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "success",
            'resetpassword' => $resetpassword
        ], 200);
    }

    public function update(Request $request, $id)
    {
         $resetpassword = ResetPassword::findOrFail($id);
         $resetpassword->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "success",
            'resetpassword' => $resetpassword
        ], 200);
    }    
}
