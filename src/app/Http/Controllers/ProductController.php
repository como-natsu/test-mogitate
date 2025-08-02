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
        $seasons = Season::all();
        return view('register', compact('seasons'));
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
        $product = Product::withTrashed()->with('seasons')->find($productId);
        $seasons = Season::all();

        if ($product && $product->trashed()) {
        $product = null;
        }

        return view('edit', compact('product', 'seasons'));
    }

    public function update(UpdateProductRequest $request,$productId)
    {
        $product = Product::findOrFail($productId);

        $updateData = [
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
    ];

        if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $updateData['image'] = 'storage/' . $imagePath;
    }

        $product->update($updateData);

        $product->seasons()->sync($request->input('season_id'));

        return redirect('/products')->with('message', '変更を保存しました');
    }


    public function destroy($productId)
    {
        $product = Product::find($productId);
        if ($product) {
        $product->delete();
        }

        //return view('edit', ['product' => null, 'seasons' => Season::all()]);
        return redirect('/products')->with('message', '削除しました');
    }

}
