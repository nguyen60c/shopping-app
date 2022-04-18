<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\products\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /*
     * Display a listing of the resource for admins and sellers
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view("products.index", compact("products"));
    }

    /*
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /*
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
        if($request->validated()){
            /*Image*/
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            /*Store info here*/
            $product->user_id = auth()->id();
            $product->name = $request->name;
            $product->original = $request->original;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')
            ->withSuccess(__('product created successfully.'));
    }

    /*
     * Display the specified resource
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);
        return view("products.show", [
            "product" => $product
        ]);
    }

    public function fetchProduct(Product $product){
        $product = Product::find($product->id);
        return response()->json([
            "product" => $product
        ]);
    }

    public function fetchProducts(){
        $products = Product::all();
        return response()->json([
            "products" => $products
        ]);
    }

    /*
     * Show the form for editing the specified resource
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("products.edit", [
            "product" => $product
        ]);
    }

    /*
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        return redirect()->route('products.index')
            ->withSuccess(__('product updated successfully.'));
    }

    /*
     * Remove the specified resource from storage
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        $product->delete();

        return redirect()->route('products.index')
            ->withSuccess(__('product deleted successfully.'));
    }
}
