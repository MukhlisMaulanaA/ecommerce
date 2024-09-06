<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
  data-scroll="false">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
      </ol>
      <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <li class="nav-item mt-5 mt-lg-0 text-center">
          <div class="btn-group">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="40"
              alt="Avatar" loading="lazy" class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false" />
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="{{ route('home') }}">Store</a></li>
              <li>
                <hr>
              </li>
              {{ html()->form('POST', route('logout'))->open() }}
              @csrf
              <li><button class="dropdown-item" type="submit">Logout</button></li>
              {{ html()->form()->close() }}
            </ul>
          </div>
        </li>
      </div>
    </div>
  </div>
</nav>
<!-- End Navbar -->
