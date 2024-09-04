@extends('themes.indotoko.layouts.app')
@section('content')
  <section class="breadcrumb-section pb-4 pb-md-4 pt-4 pt-md-4">
    <div class="container">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ '/' }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"></li>
        </ol>
      </nav>
    </div>
  </section>
  <section class="main-content">
    <div class="container">
      <div class="row">
        <section class="col-lg-12 col-md-12 shopping-cart">
          <div class="card mb-4 bg-light border-0 section-header">
            <div class="card-body p-5">
              <h2 class="mb-0">Order List</h2>
            </div>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Status</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $order->code }}</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->base_total_price }}</td>
                  <td>
                    <a href="{{ $order->payment_url }}" class="text-primary fs-3"><i class='bx bxs-show'></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </section>
      </div>
    </div>
  </section>
@endsection
