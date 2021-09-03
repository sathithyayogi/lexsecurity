<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - SB Admin T</title>
    <link href="https://satmotion360.herokuapp.com/css/style.css" rel="stylesheet">
    <link
      href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="sb-nav-fixed">
      <div id="app">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Satmotion360</a>
      <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
      </button>

    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Dashboard</div>
              <a class="nav-link" href="/">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Device Status
              </a>
              <a class="nav-link" href="/diagnostics">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-tachometer-alt"></i>
                </div>
                Device Detail View
              </a>

              <div class="sb-sidenav-menu-heading">Devices</div>
              <a class="nav-link" href="/devices">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-chart-area"></i>
                </div>
                List
              </a>
              <a class="nav-link" href="/devices/create">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Add
              </a>

              <div class="sb-sidenav-menu-heading">Config</div>
              <a class="nav-link" href="/device/mobilenumber/">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-chart-area"></i>
                </div>
                Mobile Number
              </a>


            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Satmotion361
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">

        @include('inc.messages')
        @yield('content')

        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid">
            <div
              class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Your Website 2020</div>
              <div>
                {{-- <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a> --}}
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
</div>
</div>
<script src="/js/app.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.js"
      integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
      crossorigin="anonymous"></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"
      crossorigin="anonymous"
    ></script>

    <script src="https://satmotion360.herokuapp.com/js/datatables-demo.js"></script>
    <script src="https://satmotion360.herokuapp.com/js/nav.js"></script>
  </body>
</html>
