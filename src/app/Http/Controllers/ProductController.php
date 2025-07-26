<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::paginate(6);
        return view('products',compact('products',));
    }

    public function register()
    {
        return view ('register');
    }

    public function store(StoreProductRequest $request)
    {
        $imagePath = $request->file('image')->store('image','public');


    $product = Product::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'image' => 'storage/' . $imagePath,
    ]);

    $product->seasons()->attach($request->input('season_id'));

    return redirect('/products')->with('success', '商品を登録しました');
    }



    public function search(Request $request)
    {
        $name = $request->input('name');
        $priceOrder = $request->input('price_order');

        $query = Product::ProductSearch($name);

        if($priceOrder === 'asc' || $priceOrder === 'desc') {
            $query->orderBy('price',$priceOrder);
        }

        $products = $query->paginate(6)->appends($request->all());


        return view('products', compact('products'));

    }



    public function edit(Request $request, $productId)
    {
        $product = Product::with('seasons')->find($productId);
        $seasons =Season::all();
        return view('edit', compact('product', 'seasons'));
    }
}