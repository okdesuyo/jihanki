<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Company;

class ProductController extends Controller
{
  protected $product;

  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  public function index(Request $request)
  {
    $data = $this->product->index($request);

    return view('index', $data);
  }

  public function create()
  {
    $companies = Company::all();

    return view('create')->with('companies', $companies);
  }

  public function store(Request $request)
  {
    return $this->product->createProduct($request);
  }

  public function show(Product $product)
  {
    $companies = Company::all();

    return view('show', compact('product'))
      ->with('page_id', request()->page_id)
      ->with('companies', $companies);
  }

  public function edit(Product $product)
  {
    $companies = Company::all();

    return view('edit', compact('product'))
      ->with('companies', $companies);
  }

  public function update(Request $request, Product $product)
  {
    return $this->product->updateProduct($request, $product);
  }

  public function destroy(Product $product)
  {
    return $this->product->deleteProduct($product);
  }
}
