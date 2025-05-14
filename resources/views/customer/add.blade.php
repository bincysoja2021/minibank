@extends('layouts.header')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ url ('/home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ url ('/list-customer')}}">Customers</a>
          </li>
          <li class="breadcrumb-item active">Add New Customer</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                Add New Customer
                <a href="{{ url ('/list-customer')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
              </div>
              <div class="card-body">

              @if(session('status'))
              <div class="alert alert-success mb-1 mt-1">
              {{ session('status') }}
              </div>
              @endif


                <form action="{{ route('store') }}" method="POST" >
                  @csrf
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="firstName">First name</label>
                        <input
                          class="form-control"
                          id="firstName" name="firstName" required="" autocomplete="off"
                          type="text"
                          aria-describedby="nameHelp"
                          placeholder="Enter first name"
                        />
                        @error('firstName')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="lastName">Last name</label>
                        <input
                          class="form-control"
                          id="lastName" name="lastName"  autocomplete="off"
                          type="text"
                          aria-describedby="nameHelp"
                          placeholder="Enter last name"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="email">Email address</label>
                        <input
                          class="form-control"
                          id="email" name="email"  autocomplete="off" required
                          type="email"
                          aria-describedby="emailHelp"

                          placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
    title="Please enter a valid email address (e.g. user@example.com)"
                        />
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="phone">Phone number</label>
                        <input class="form-control"
                            id="phone"
                            name="phone"
                            type="tel"
                            pattern="\d{10}"
                            maxlength="10"
                            minlength="10"
                            required
                            autocomplete="off"
                            placeholder="Enter 10-digit phone number"
                        />
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="password">Password</label>
                          <div class="input-group">

                        <input
                          class="form-control"
                          id="password" name="password" required="" autocomplete="off"
                          type="password"
                        />
                         <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
    <i id="eyeIcon" class="fas fa-eye"></i>
  </button></div>
                        @error('password')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="col-md-6">
                        <label for="password_confirmation">Password  Confirmation</label>
                        <input
                          class="form-control"
                          id="password_confirmation" name="password_confirmation"  autocomplete="off"
                          type="password" required
                          aria-describedby="nameHelp"
                          placeholder="Confirm password"
                        />
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">Create Customer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
  function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>

      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
      <!-- Custom scripts for all pages-->
      <script>
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
      </script>
      @extends('layouts.footer')
    </div>
  </body>
</html>
