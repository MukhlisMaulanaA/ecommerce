<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <title>
    Dashboar Admin - Al-FakihStore
  </title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->

  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">

  <style>
    .sidnav li .submenu {
      list-style: none;
      margin: 0;
      padding: 0;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  </style>

  @vite(['resources/css/nucleo-icons.css', 'resources/css/nucleo-svg.css', 'resources/css/argon-dashboard.min.css', 'resources/sass/argon-dashboard.scss', 'resources/js/argon-dashboard.min.js', 'resources/js/core/popper.min.js', 'resources/js/core/bootstrap.min.js', 'resources/js/plugins/perfect-scrollbar.min.js', 'resources/js/plugins/smooth-scrollbar.min.js', 'resources/js/plugins/chartjs.min.js', 'resources/js/config-chart.js'])
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @include('themes.indotoko.shared.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    @include('themes.indotoko.shared.navbar')
    @yield('content')
  </main>

  <!--   Core JS Files   -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>

  <script>
    new DataTable('#products-table', {
      // responsive: true,
      scrollX: true
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

        element.addEventListener('click', function(e) {

          let nextEl = element.nextElementSibling;
          let parentEl = element.parentElement;

          if (nextEl) {
            e.preventDefault();
            let mycollapse = new bootstrap.Collapse(nextEl);

            if (nextEl.classList.contains('show')) {
              mycollapse.hide();
            } else {
              mycollapse.show();
              // find other submenus with class=show
              var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
              // if it exists, then close all of them
              if (opened_submenu) {
                new bootstrap.Collapse(opened_submenu);
              }
            }
          }
        }); // addEventListener
      }) // forEach
    });
    // DOMContentLoaded  end
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const iconNavbarSidenav = document.getElementById('iconNavbarSidenav');
      const body = document.body;

      iconNavbarSidenav.addEventListener('click', function(e) {
        e.preventDefault();

        // Toggle class 'g-sidenav-pinned'
        body.classList.toggle('g-sidenav-pinned');

        // Memastikan class 'g-sidenav-show' dan 'bg-gray-100' selalu ada
        if (!body.classList.contains('g-sidenav-show')) {
          body.classList.add('g-sidenav-show');
        }
        if (!body.classList.contains('bg-gray-100')) {
          body.classList.add('bg-gray-100');
        }
      });
    });
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script></script>

</body>

</html>
