@extends('themes.indotoko.layouts.app')

@section('content')
  <section class="breadcrumb-section pb-4 pb-md-4 pt-4 pt-md-4">
    <div class="container">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
      </nav>
    </div>
  </section>
  <section class="main-content">
    <div class="container">
      @include('themes.indotoko.shared.flash')
      <form>
        <div class="row mb-3">
          <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10">
            <label for="name">{{ $users->name }}</label>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <label for="name">{{ $users->email }}</label>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label">Address</label>
          <div class="col-sm-10">
            @foreach ($addresses as $address)
            <div class="col-sm-10 d-flex">
              <label for="address" class="fw-bold">{{ $loop->iteration }}. {{ $address->label }} : </label>
              <address class="ms-3">
                <a>{{ $address->first_name }} {{ $address->last_name }}</a>
                <br>
                {{ $address->address1 }}
                <br>
                {{ $address->address2 }}
                <br>
                <a title="Phone">Phone: {{ $address->phone }}</a>
                <br>
                <a class="btn btn-primary" href="{{ route('address.edit', ['address_id' => $address->id]) }}">Edit Address</a>
              </address>
            </div>
            @endforeach
          </div>
        </div>
        <a class="btn btn-warning" href="{{ route('profile.edit') }}">Edit Profile</a>
      </form>
    </div>
  </section>
@endsection
