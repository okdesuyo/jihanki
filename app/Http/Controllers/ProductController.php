<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Company;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $products = Product::select([
      'b.id',
      'b.img_path',
      'b.product_name',
      'b.price',
      'b.stock',
      'r.company_name as company_id',
    ])
      ->from('products as b')
      ->join('companies as r', function ($join) {
        $join->on('b.company_id', '=', 'r.id');
      })
      ->orderBy('b.id', 'ASC')
      ->paginate(5);
    return view('index', compact('products'))
      ->with('page_id', request()->page)
      ->with('i', (request()->input('page', 1) - 1) * 5);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $companies = Company::all();
    return view('create')
      ->with('companies', $companies);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'product_name' => 'required|max:20',
      'company_id' => 'required|integer ',
      'price' => 'required|integer',
      'stock' => 'required|integer',
    ]);

    $input = $request->all();
    Product::create($input);
    return redirect()->route('products.index')
      ->with('success', '商品を登録しました');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    $companies = Company::all();
    return view('show', compact('product'))
      ->with('page_id', request()->page_id)
      ->with('companies', $companies);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    $companies = Company::all();
    return view('edit', compact('product'))
      ->with('companies', $companies);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    $request->validate([
      'product_name' => 'required|max:20',
      'price' => 'required|integer',
      'company_id' => 'required|integer',
    ]);

    $product->product_name = $request->input(["product_name"]);
    $product->price = $request->input(["price"]);
    $product->company_id = $request->input(["company_id"]);
    $product->comment = $request->input(["comment"]);
    //    $product->user_id = \Auth::user()->id;
    $product->save();

    return redirect()->route('products.index')->with('success', '情報を更新しました');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    $product->delete();
    return redirect()->route('products.index')
      ->with('success', '商品「' . $product->product_name . '」を削除しました');
  }
}
