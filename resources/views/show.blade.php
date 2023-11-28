@extends('app')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品情報詳細画面</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="{{ url('/products') }}?page={{ $page_id }}">戻る</a>
    </div>
  </div>
</div>

<div class='row'>
  <div class='col-12 mb-2 mt-2 d-flex'>
    <label class='col-1 mb-2 mt-2'>ID</label>
    <div class='form-control'>
      {{$product->id}}.
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>商品画像</label>
    <div class='form-control'>
      <img src="{{ asset('storage/image/' . $product->img_path) }}" width="40" height="40" alt="image">
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>商品名</label>
    <div class='form-control'>
      {{ $product->product_name }}
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>メーカー</label>
    <div class='form-control'>
      @foreach ($companies as $company)
      @if($company->id==$product->company_id) {{ $company->company_name }} @endif
      @endforeach
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>価格</label>
    <div class='form-control'>
      {{ $product->price }}
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>在庫数</label>
    <div class="form-control">
      {{ $product->stock }}
    </div>
  </div>
  <div class="col-12 mb-2 mt-2 d-flex">
    <label class='col-1 mb-2 mt-2'>コメント</label>
    <div class="form-control">
      {{ $product->comment }}
    </div>
  </div>
</div>

@endsection