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
    <title>MINI BANK | Admin</title>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset ('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Custom fonts for this template-->
    <link
      href="{{ asset ('vendor/font-awesome/css/font-awesome.min.css') }}"
      rel="stylesheet"
      type="text/css"
    />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="{{ asset ('css/sb-admin.css') }}" rel="stylesheet" />
  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav
      class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top"
      id="mainNav"
    >
      <a class="navbar-brand" href="index.html">MINI BANK</a>
      <button
        class="navbar-toggler navbar-toggler-right"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li
            class="nav-item active"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            <a class="nav-link" href="{{ url ('/home')}}">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li
            class="nav-item"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            <a class="nav-link" href="{{ url ('/list-customer')}}">
              <i class="fa fa-fw fa-user"></i>
              <span class="nav-link-text">Customers</span>
            </a>
          </li>
          <li
            class="nav-item"
            data-toggle="tooltip"
            data-placement="right"
            title="Dashboard"
          >
            
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>
          <span class="nav-link-text">{{ __('Logout') }}</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
          </form>

          </li>
        </ul>      
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
       
      </div>
    </nav>