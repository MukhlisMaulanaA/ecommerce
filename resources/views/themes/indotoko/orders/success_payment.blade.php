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
        <div class="card text-white bg-success mb-3">
          <div class="card-header">Payments Status</div>
          <div class="card-body">
            <h5 class="card-title">{{ $dataSuccess['status'] }}</h5>
            <p class="card-text">Nominal = Rp. {{ $dataSuccess['price'] }}</p>
            <p class="card-text">Code = {{ $dataSuccess['code'] }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
