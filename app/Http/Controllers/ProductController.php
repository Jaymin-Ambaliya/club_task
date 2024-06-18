<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::latest('id')->get();
        $clubs = Club::all('id', 'club_name');
        // return view('product.list', compact('products','clubs'));

        return view("product.list", compact('clubs'));
    }

    public function fetchdata()
    {
        $data = Product::latest('id')->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::all('id', 'club_name');
        return view('product.create', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        $validatedProduct = $request->validate([
            'club_id' => ['required'],
            'title' => ['required'],
            'product_title' => ['required'],
            'type' => ['required'],
        ],[
            'club_id.required' => 'Club Name field is required.',
            'title.required' => 'Title field is required.',
            'product_title.required' => 'Product Title field is required.',
            'type.required'=> 'Type field is required',
        ]);

        Product::create($validatedProduct);

        return response()->json(['success' => 'Product  created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $product = Product::where($where)->first();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedProduct = $request->validate([
            'club_id' => ['required'],
            'title' => ['required'],
            'product_title' => ['required'],
            'type' => ['required'],
        ],[
            'club_id.required' => 'Club Name field is required.',
            'title.required' => 'Title field is required.',
            'product_title.required' => 'Product Title field is required.',
            'type.required'=> 'Type field is required',
        ]);
        $product = product::find($id);
        $product->club_id = $request->input('club_id');
        $product->title = $request->input('title');
        $product->product_title = $request->input('product_title');
        $product->type = $request->input('type');

        $product->save();

        return response()->json(['success' => 'Product  created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->delete();

        return response()->json($product);
    }
}
