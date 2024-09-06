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
      <form class="row g-3" method="post" action="{{ route('address.update') }}">
        @csrf
        @method('patch')
        <input type="text" name="id" id="id" value="{{ $addresses->id }}" hidden>
        <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
        <div class="col-md-6">
          <label for="inputFirst4" class="form-label fw-bold">Label</label>
          <input type="text" class="form-control" name="label" value="{{ old('label', $addresses->label) }}" id="label" required>
        </div>
        <div class="col-md-6 d-flex flex-column mt-2 justify-content-end">
          <div class="col-sm-3">
            <input class="form-check-input delivery-address" type="radio" value="1" {{ old('is_primary', $addresses->is_primary) == 1 ? 'checked' : '' }} name="is_primary" id="homeRadio" required>
            <label for="is_primary fw-bold">Primary</label>
          </div>
          <div class="col-sm-3">
            <input class="form-check-input delivery-address" type="radio" value="0" {{ old('is_primary', $addresses->is_primary) == 0 ? 'checked' : '' }} name="is_primary" id="homeRadio" required>
            <label for="is_secondary fw-bold">Secondary</label>
          </div>
        </div>
        <div class="col-md-6">
          <label for="inputFirst4" class="form-label fw-bold">First Name</label>
          <input type="text" class="form-control" name="first_name"
            value="{{ old('first_name', $addresses->first_name) }}" id="first_name" required>
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label fw-bold">Last Name</label>
          <input type="text" class="form-control" name="last_name"
            value="{{ old('last_name', $addresses->last_name) }}" id="last_name" required>
        </div>
        <div class="col-md-6">
          <label for="inputPhone4" class="form-label fw-bold">Phone</label>
          <input type="phone" class="form-control" name="phone" value="{{ old('phone', $addresses->phone) }}"
            id="phone" required>
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label fw-bold">Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email', $addresses->email) }}"
            id="email" required>
          
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label fw-bold">Address</label>
          <input type="text" class="form-control" name="address1" id="address1"
            placeholder="{{ old('address1', $addresses->address1) }}" required>
        </div>
        <div class="col-12">
          <label for="inputAddress" class="form-label fw-bold">Address 2</label>
          <input type="text" class="form-control" name="address2" id="address2"
            placeholder="{{ old('address2', $addresses->address2) }}" required>
        </div>
        <div class="col-md-6">
          <label for="inputCity" class="form-label fw-bold">Province</label>
          <select id="inputCity" name="province" class="form-select" required>
            @foreach ($provinces as $province)
              <option value="{{ $province['province_id'] }}"
                {{ old('province', $addresses->province) == $province['province_id'] ? 'selected' : '' }}>
                {{ $province['province'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="inputState" class="form-label fw-bold">City</label>
          <select id="inputState" name="city" class="form-select" required>
            <option selected>Choose...</option>
            @foreach ($cities as $city)
              <option value="{{ $city['city_id'] }}"
                {{ old('province', $addresses->city) == $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <label for="inputZip" class="form-label fw-bold">Zip</label>
          <input type="number" class="form-control" name="postcode"
            value="{{ old('postcode', $addresses->postcode) }}" id="postcode" required>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </section>
@endsection
