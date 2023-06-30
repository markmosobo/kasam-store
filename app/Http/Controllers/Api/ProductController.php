<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Activity;
use App\Models\Product;
use App\Models\ProductActivity;
use App\Models\RestockProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
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
        if(!empty($request->image)){
            $photo_name = time().'.' . explode('/', explode(':', substr($request->image,0,strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('products/').$photo_name);

        }else{
            $photo_name = '';
        }
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'image' => $photo_name,
            'size' => $request->size,
            'pieces' => $request->pieces,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'created_by' => $request->created_by
        ]);
        //record user activity
        Activity::create([
            'description' => 'checked in a new product',
            'created_by' => $request->created_by,
            'status' => 2
        ]);

        return response()->json([
            'status' => true,
            'message' => "Product Created successfully!",
            'product' => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => "Product",
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        //record activity
        Activity::create([
            'description' => 'updated an existing product',
            'created_by' => $request->created_by,
            'status' => 3
        ]);

        //record product history
        ProductActivity::create([
            'description' => 'details updated ',
            'product_id' => $product->id,
            'created_by' => $request->created_by,
            'status' => 3
        ]);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, 204);
    }

    public function restock(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'buying_price' => $request->buying_price,
            'pieces' => $request->pieces
        ]);

        $restockproduct = RestockProduct::create([
            'product_id' => $id,
            'pieces' =>$request->newpieces,
            'buying_price' => $request->buying_price,
            'supplier_id' => $request->supplier_id,
            'created_by' => $request->created_by
        ]);
        //record activity
        Activity::create([
            'description' => 'restocked an existing product',
            'created_by' => $request->created_by,
            'status' => 4
        ]);

        //record product history
        ProductActivity::create([
            'description' => $request->newpieces .' pieces restocked',
            'product_id' => $product->id,
            'created_by' => $request->created_by,
            'status' => 2
        ]);

    }

    public function reducePieces(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update(array('pieces' => $request->pieces));

        $product->save();

    }

    public function productRestock(Request $request, $id)
    {
        $monthrestocks = RestockProduct::where('product_id', $id)->with('product','user')->orderByDesc('created_at')->whereMonth('created_at', Carbon::now()->month)->get();
        $lastmonthrestocks = RestockProduct::where('product_id', $id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get();
        $lastninetyrestocks = RestockProduct::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subDays(89)->startOfDay(), Carbon::now()->endOfDay()])->get();
        $yearrestocks = RestockProduct::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        $quarterlyrestocks = RestockProduct::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->startOfQuarter(), Carbon::now()->endOfDay()])->get();
        $lastyearrestocks = RestockProduct::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->whereBetween('created_at',
        [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->get();
        $allrestocks = RestockProduct::where('product_id',$id)->with('product','user')->orderByDesc('created_at')->get();

        return response()->json([
            "lists" => [
                'monthrestocks' => $monthrestocks,
                'lastmonthrestocks' => $lastmonthrestocks,
                'lastninetyrestocks' => $lastninetyrestocks,
                'yearrestocks' => $yearrestocks,
                'quarterlyrestocks' => $quarterlyrestocks,
                'lastyearrestocks' => $lastyearrestocks,
                'allrestocks' => $allrestocks

            ]
        ]);
    
    }
}
