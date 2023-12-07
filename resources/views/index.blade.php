@extends('app')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2 style="font-size:1rem;">商品情報一覧画面</h2>
    </div>
  </div>
</div>

<div>
  <div class="container d-flex">
    <div class="flex-grow-1">
      @auth
      <a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
      @endauth
    </div>

    <div class="flex-shrink-0">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        @auth
        <a class="btn btn-secondary" href="route('logout')" onclick="event.preventDefault();
                      this.closest('form').submit();">
          {{ __('ログアウト') }}
        </a>
        @endauth
      </form>
    </div>
  </div>
</div>

@if(session('success'))
<div class="my-2 alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="py-2">
  <form action="{{ route('products.index') }}" method="GET" class="d-flex">
    <div class="mx-2">
      {{-- <label for="search" class="visually-hidden">検索:</label> --}}
      <input type="text" name="q" id="search" class="form-control" value="{{ isset($query) ? $query : '' }}"
        placeholder="商品名を入力">
    </div>

    <div class="mx-2">
      {{-- <label for="company_id" class="visually-hidden">メーカー名:</label> --}}
      <select name="company_id" id="company_id" class="form-control">
        <option value="">メーカー名</option>
        @foreach($companies as $companyId => $companyName)
        <option value="{{ $companyId }}" {{ request('company_id')==$companyId ? 'selected' : '' }}>{{ $companyName }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mx-2">
      <button type="submit" class="btn btn-info">検索</button>
    </div>
  </form>
</div>

<div class="py-2">
  <table class="table table-bordered">
    <tr style=" text-align:center">
      <th>ID</th>
      <th>商品画像</th>
      <th>商品名</th>
      <th>価格</th>
      <th>在庫数</th>
      <th>メーカー名</th>
      <th></th>
      <th></th>
    </tr>
    @foreach ($products as $product)
    <tr style=" text-align:center">
      <td>{{$product->id}}</td>
      <td><img src="{{ asset('storage/image/' . $product->img_path) }}" width="40" height="40" alt="image"></td>
      {{-- <td><a href="{{route('product.show',$product->id)}}?page_id={{ $page_id }}">{{$product->product_name}}</a>
      </td> --}}
      <td>{{$product->product_name}}</td>
      <td>{{$product->price}}円</td>
      <td>{{$product->stock}}個</td>
      <td>{{$product->company_id}}</td>
      <td>
        @auth
        <a class="btn btn-sm btn-primary" href="{{ route('product.show',$product->id) }}?page_id={{ $page_id }}">詳細</a>
        @endauth
      </td>
      <td>
        @auth
        <form action=" {{ route('product.destroy',$product->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
        </form>
        @endauth
      </td>
    </tr>
    @endforeach
  </table>
</div>

{!! $products->links('pagination::bootstrap-5') !!}

@endsection