@extends('app')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品新規登録画面</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
    </div>
  </div>
</div>

<div style="text-align:left;">
  <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12 mb-2 mt-2">
        <div class="d-flex">
          <input type="text" name="product_name" class="form-control" placeholder="商品名">
        </div>
        @error('product_name')
        <span style="color:red;">商品名を20文字以内で入力してください</span>
        @enderror
      </div>
      <div class="col-12 mb-2 mt-2">
        <div class="d-flex">
          <select name="company_id" class="form-select">
            <option>メーカー名を選択してください</option>
            @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
          </select>
        </div>
        @error('company_id')
        <span style="color:red;">メーカーを選択してください</span>
        @enderror
      </div>
      <div class="col-12 mb-2 mt-2">
        <div class="d-flex">
          <input type="text" name="price" class="form-control" placeholder="価格">
        </div>
        @error('price')
        <span style="color:red;">価格を入力してください</span>
        @enderror
      </div>
      <div class="col-12 mb-2 mt-2">
        <div class="d-flex">
          <input type="text" name="stock" class="form-control" placeholder="在庫数">
        </div>
        @error('stock')
        <span style="color:red;">在庫数を入力してください</span>
        @enderror
      </div>
      <div class="col-12 mb-2 mt-2">
        <div class="d-flex">
          <textarea class="form-control" style="height:100px" name="comment" placeholder="コメント"></textarea>
        </div>
        @error('comment')
        <span style="color:red;">コメントを140文字以内で入力してください</span>
        @enderror
      </div>
      <div class="col-12 mb-2 mt-2 ">
        <div class="d-flex">
          <input type="file" id="img_path" name="img_path">
        </div>
      </div>
      <div class="col-12 mb-2 mt-2">
        <button type="submit" class="btn btn-primary w-40">登録</button>
      </div>
    </div>
  </form>
</div>
@endsection