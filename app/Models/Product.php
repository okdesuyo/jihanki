<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Product extends Model
{
  protected $fillable = [
    'product_name', 'price', 'stock', 'company_id', 'comment', 'img_path'
  ];

  public function index(Request $request)
  {
    $query = $request->input('q');
    $companyId = $request->input('company_id');

    $companies = DB::table('companies')->pluck('company_name', 'id');

    $productsQuery = $this->getProductsQuery();

    if ($query) {
      $productsQuery->where('b.product_name', 'like', '%' . $query . '%');
    }

    if ($companyId) {
      $productsQuery->where('b.company_id', $companyId);
    }

    $products = $productsQuery->paginate(5);

    return [
      'products' => $products,
      'companies' => $companies,
      'page_id' => request()->page,
      'i' => (request()->input('page', 1) - 1) * 5,
    ];
  }

  public static function validationRules($productId = null)
  {
    return [
      'img_path' => 'image|max:2048',
      'product_name' => 'required|max:20',
      'company_id' => 'required|integer',
      'price' => 'required|integer',
      'stock' => 'required|integer',
      'comment' => 'max:255',
    ];
  }

  public function createProduct(Request $request)
  {
    $request->validate(self::validationRules());

    return DB::transaction(function () use ($request) {
      $data = $this->prepareData($request);

      if ($request->hasFile('img_path')) {
        $original = $request->file('img_path')->getClientOriginalName();
        $name = date('Ymd_His') . '_' . $original;

        $request->file('img_path')->move('storage/image', $name);
        $data['img_path'] = $name;
      }

      $this->create($data);

      return redirect()->route('products.index')
        ->with('success', '商品を登録しました');
    });
  }

  public function updateProduct(Request $request, Product $product)
  {
    $request->validate(self::validationRules($product->id));

    return DB::transaction(function () use ($request, $product) {
      $data = $this->prepareData($request);

      if ($request->hasFile('img_path')) {
        $original = $request->file('img_path')->getClientOriginalName();
        $name = date('Ymd_His') . '_' . $original;

        $request->file('img_path')->move('storage/image', $name);
        $data['img_path'] = $name;
      }

      $product->update($data);

      return redirect()->route('products.index')->with('success', '情報を更新しました');
    });
  }

  public function deleteProduct(Product $product)
  {
    return DB::transaction(function () use ($product) {
      $product->delete();

      return redirect()->route('products.index')
        ->with('success', '商品「' . $product->product_name . '」を削除しました');
    });
  }

  protected function getProductsQuery()
  {
    return $this->select([
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
      ->orderBy('b.id', 'DESC');
  }

  protected function prepareData(Request $request)
  {
    return [
      'product_name' => $request->input("product_name"),
      'price' => $request->input("price"),
      'stock' => $request->input("stock"),
      'company_id' => $request->input("company_id"),
      'comment' => $request->input("comment"),
    ];
  }
}
