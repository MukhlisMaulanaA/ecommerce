@extends('themes.indotoko.layouts.dashboard')

@section('content')
  <div class="container">
    <h1 class="text-white">Tambah Produk Baru</h1>
    @include('themes.indotoko.shared.flash')

    <section class="bg-white p-3 rounded-2 shadow-lg">
      <form action="{{ route('dashboards_products.store') }}" method="POST" enctype="multipart/form-data">
        <input type="text" value="{{ Auth::user()->id }}" name="user_id" hidden>
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Produk</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="price" class="form-label">Harga Produk</label>
            <div class="input-group">
              <div class="input-group-text">Rp.</div>
              <input type="number" class="form-control" id="price" name="price" required>
            </div>
          </div>
          <div class="col mb-3">
            <input type="checkbox" id="discount-checkbox" name="has_discount" value="1">
            <label for="discount-checkbox">Ceklist jika ada diskon. </label>
            <label for="sale_price" class="form-label">Harga Setelah Diskon</label>
            <div class="input-group">
              <div class="input-group-text">Rp.</div>
              <input type="number" class="form-control" id="sale_price" name="sale_price" disabled>
            </div>
          </div>
        </div>
        <div class="mb-3">
        </div>
        <div class="mb-3">
          <label for="floatingTextarea">Exerpt</label>
          <textarea class="form-control" name="excerpt" placeholder="Write Exerpt here" id="floatingTextarea"></textarea>
        </div>
        <div class="mb-3">
          <label for="floatingTextarea">Deskripsi</label>
          <textarea class="form-control" name="body" placeholder="Write Description here" id="floatingTextarea"></textarea>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="stock_status" class="form-label">Status Stok</label>
            <select class="form-control" id="stock_status" name="stock_status" required>
              <option value="IN_STOCK">Tersedia</option>
              <option value="OUT_OF_STOCK">Tidak Tersedia</option>
            </select>
          </div>
          <div class="col mb-3">
            <label for="weights">Berat Produk</label>
            <div class="input-group">
              <input type="number" name="weight" class="form-control">
              <div class="input-group-text">Kg</div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="featured_image" class="form-label">Gambar Produk</label>
          <input type="file" class="form-control" id="featured_image" name="featured_image">
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
      </form>
    </section>
  </div>
  <script>
    document.getElementById('discount-checkbox').addEventListener('change', function() {
      const salePriceInput = document.getElementById('sale_price');
      if (this.checked) {
        salePriceInput.disabled = false;
        salePriceInput.required = true; // Membuat input wajib jika diskon diaktifkan
      } else {
        salePriceInput.disabled = true;
        salePriceInput.required = false;
        salePriceInput.value = ''; // Reset nilai jika diskon tidak diaktifkan
      }
    });
  </script>
@endsection
