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
                  <td>
                    @if ($order->status == 'CONFIRMED')
                    <span class="badge bg-success">{{ $order->status }}</span>
                    @else
                    <span class="badge bg-warning">{{ $order->status }}</span>
                    @endif
                  </td>
                  <td>Rp. {{ number_format($order->grand_total) }}</td>
                  <td class="">
                    @if ($order->status == 'CONFIRMED')
                    
                    @else
                    <a href="{{ $order->payment_url }}" class="btn btn-primary">
                      Bayar
                    </a>
                    @endif
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
