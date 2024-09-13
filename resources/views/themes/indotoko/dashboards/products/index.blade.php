@extends('themes.indotoko.layouts.dashboard')

@section('content')
  <div class="container">
    <h1 class="text-white">Products List</h1>
    @include('themes.indotoko.shared.flash')
    <section class="bg-white rounded-2 p-2">
      <table class="table table-striped" id="products-table">
        <thead>
          <tr class="">
            <th>No.</th>
            <th>Nama Produk</th>
            <th>Gambar</th>
            <th>SKU</th>
            <th>Harga</th>
            <th>Harga Diskon</th>
            <th>Status</th>
            <th>Stok Status</th>
            <th>Tanggal Publish</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->name }}</td>
              <td><img src="{{ url('storage/' . $product->featured_image) }}" alt="{{ $product->slug }}" height="30px"></td>
              <td>{{ $product->sku }}</td>
              <td>Rp. {{ number_format($product->price) }}</td>
              <td>Rp. {{ number_format($product->sale_price) }}</td>
              <td>{{ $product->status }}</td>
              <td>{{ $product->stock_status }}</td>
              <td>{{ $product->publish_date ? $product->publish_date : '-' }}</td>
              <td>
                <!-- Hanya tampilkan tombol Publish jika status produk adalah DRAFT -->
                @if ($product->status == 'DRAFT')
                  <form action="{{ route('dashboards_products.publish', $product->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-warning"
                      onclick="return confirm('Apakah Anda yakin ingin mempublish produk ini?')">Publish</button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </div>
@endsection
