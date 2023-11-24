@extends('app')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品情報編集画面</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="{{ url('/products') }}">戻る</a>
    </div>
  </div>
</div>

<form action="{{ route('product.update',$product->id) }}" method="POST">
  @method('PUT')
  @csrf

  <div class="row">
    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control"
          placeholder="商品名">
        @error('product_name')
        <span style="color:red;">名前を20文字以内で入力してください</span>
        @enderror
      </div>
    </div>
    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <input type="text" name="price" value="{{ $product->price }}" class="form-control" placeholder="価格">
        @error('price')
        <span style="color:red;">価格を数字で入力してください</span>
        @enderror
      </div>
    </div>
    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <select name="company_id" class="form-select">
          <option>メーカーを選択してください</option>
          @foreach ($companies as $company)
          <option value="{{ $company->id }}" @if($company->company_name==$product->company) selected @endif>{{
            $company->company_name }}
          </option>
          @endforeach
        </select>
        @error('company_id')
        <span style="color:red;">メーカーを選択してください</span>
        @enderror
      </div>
    </div>
    <div class="col-12 mb-2 mt-2">
      <div class="form-group">
        <textarea class="form-control" style="height:100px" name="comment"
          placeholder="詳細">{{ $product->comment }}</textarea>
        @error('comment')
        <span style="color:red;">詳細を140文字以内で入力してください</span>
        @enderror
      </div>
    </div>
    <div class="col-12 mb-2 mt-2">
      <button type="submit" class="btn btn-primary w-100">変更</button>
    </div>
  </div>
</form>
@endsection