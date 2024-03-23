<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{

    public function single(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)->get();
        return response()->json([
            'status' => true,
            'message' => "success",
            'invoice' => $invoice
        ], 200);
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create([
            'ref_no' => $request->ref_no,
            'items_no' => $request->items_no,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'amount_paid' => $request->amount_paid,
            'amount_due' => $request->amount_due,
            'change' => $request->change,
            'mpesa_code' => $request->mpesa_code,
            'created_by' => $request->created_by,
        ]);

        return response()->json([
                'status' => true,
                'message' => "Invoice Created successfully!",
                'invoice' => $invoice
        ], 200);
    }
}
