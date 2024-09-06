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
      <form class="row g-3" method="POST">
        @csrf
        @method('patch')
        <div class="col-md-12">
          <input class="form-check-input delivery-address" type="radio" value="{{ $addresses->id }}" name="address_id"
            id="homeRadio" {{ $addresses->is_primary ? 'checked' : '' }}>
          <label class="form-check-label text-dark" for="homeRadio">{{ $addresses->label }}</label>
        </div>
        <div class="col-md-6">
          <label for="inputFirst4" class="form-label">First Name</label>
          <input type="text" class="form-control" name="first_name"
            value="{{ old('first_name', $addresses->first_name) }}" id="first_name">
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Last Name</label>
          <input type="text" class="form-control" name="last_name"
            value="{{ old('last_name', $addresses->last_name) }}" id="last_name">
        </div>
        <div class="col-md-6">
          <label for="inputPhone4" class="form-label">Phone</label>
          <input type="phone" class="form-control" name="phone" value="{{ old('phone', $addresses->phone) }}"
            id="phone">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email', $addresses->email) }}"
            id="email">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Address</label>
          <input type="text" class="form-control" name="address1" id="address1"
            placeholder="{{ old('address1', $addresses->address1) }}">
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label">Address 2</label>
          <input type="text" class="form-control" name="address2" id="address2"
            placeholder="{{ old('address1', $addresses->address2) }}">
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Province</label>
          <select id="inputCity" class="form-select">
            @foreach ($provinces as $province)
              <option value="{{ $province['province_id'] }}"
                {{ old('province', $addresses->province) == $province['province_id'] ? 'selected' : '' }}>
                {{ $province['province'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label">City</label>
          <select id="inputState" class="form-select">
            <option selected>Choose...</option>
            @foreach ($cities as $city)
              <option value="{{ $city['city_id'] }}"
                {{ old('province', $addresses->city) == $city['city_id'] ? 'selected' : '' }}>{{ $city['province'] }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <label for="inputZip" class="form-label">Zip</label>
          <input type="number" class="form-control" name="postcode" value="{{ old('postcode', $addresses->postcode) }}"
            id="postcode">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </section>
@endsection
