<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title')Inventory - APP</title>

    @include('template.adminlte.layouts.css')
    @include('template.adminlte.layouts.js')

    @yield('css')
    <script>
      token = "";
      token = localStorage.getItem('token');
      if (!token) {
          window.location.href = "{{ url('login') }}";
      } else {
          $.ajax({
              url: "{{ url('api/me') }}",
              type: 'GET',
              dataType: 'json',
              headers: {
                  "Authorization": "Bearer " + token,
              },
              contentType: 'application/json; charset=utf-8',
          }).done(function(response, responseText, xhr) {
              localStorage.setItem('photo', response.photo);
              localStorage.setItem('email', response.email);
              localStorage.setItem('name', response.username);
              $("#name").html(response.username);
          }).fail(function(jqXHR, textStatus, errorThrown) {
              localStorage.removeItem("token");
              localStorage.removeItem("photo");
              window.location.href = "{{ url('login') }}";
          });
      }
    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        {{-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a> --}}
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            {{-- <div class="media">
              <img src="{{ asset('adminlte/img/avatar5.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          </a>
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div> --}}
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        {{-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a> --}}
        <ul class="navbar-nav ml-auto">

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="name"></span>
                  <img class="img-profile rounded-circle"
                      src="{{ asset('') }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown">
                  <form action="" id="formLogout" class="form">
                    <button class="dropdown-item" type="button" id="btnLogout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </button>
                </form>
              </div>
          </li>
      </ul>

  </nav>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
      <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @include('template.adminlte.layouts.menu')
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

    {{-- @include('template.adminlte.layouts.js') --}}

    @yield('js')
    <script>
      photo = localStorage.getItem('photo');
      name = localStorage.getItem('name');

      if (photo == null || photo == "null") {
          photo =
          "https://www.pngitem.com/pimgs/m/35-350426_profile-icon-png-default-profile-picture-png-transparent.png";
          $("#ppu").attr("src", photo);
          $("#pp").attr("src", photo);
      } else {
          $("#ppu").attr("src", "{{ asset('storage/profile') }}" + "/" + photo);
          $("#pp").attr("src", "{{ asset('storage/profile') }}" + "/" + photo);
      }

      var urlLogout = "{{ url('api/logout') }}";
      var formLogout = $("formLogout");
      $("#btnLogout").click(function() {
          postData(urlLogout, token, formLogout).done(function(response, responseText, xhr) {
              if (xhr.status === 201) {
                  console.log("error");
              } else {
                  // successAlert(response.message);
                  // $("#form").trigger('reset'); //jquery
                  // document.getElementById("btnSimpan").disabled = false;
                  // history.back();
                  localStorage.clear();
                  window.location = "{{ url('login') }}";
              }
              // successAlert(data.message);
          }).fail(function(jqXHR, textStatus, errorThrown) {
              // var err = JSON.parse(jqXHR.responseText);
              // errorAlert(err.message);
              // document.getElementById("btnSimpan").disabled = false;
              // window.location = "{{ url('data-proyek') }}";
              // document.getElementById("btnSimpan").disabled = false;
          });
      })
    </script>
</body>
</html>