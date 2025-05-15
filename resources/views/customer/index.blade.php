@extends('layouts.header')

@section('content')
    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ url ('/home')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                Listing Customers
                @if(Auth::user()->user_type=="Admin")
                <a href="{{ url ('/add-customer')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Customer</a>
                @else
                
                @endif
              </div>
              @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
                <p>{{ $message }}</p>
            </div>
        @endif
              <div class="card-body">
                <table id="datatablescustomerlist">
                  <thead>
                      <tr>
                          <th>Customer Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <!-- <th>Amount</th> -->
                          <th>User Type</th>
                          <th>Created On</th>
                          <th>Action</th>
                      </tr>
                  </thead>            
                  <tbody>
                        @foreach($cust_list as $val)
                      <tr>
                          <td>#C{{$val->id}}</td>
                          <td>{{$val->name}}</td>
                          <td>{{$val->email}}</td>
                          <td>{{$val->contact_num}}</td>
                          <!-- <td>$ {{ number_format($val->transactions->sum('total_amount'), 2) }}</td> -->
                          <td>@if($val->user_type === 'Admin')
                          <span style="color: red;">{{ $val->user_type }}</span>
                          @elseif($val->user_type === 'Customer')
                          <span style="color: blue;">{{ $val->user_type }}</span>
                          @else
                          <span>{{ $val->user_type }}</span> {{-- fallback --}}
                          @endif</td>


                          <td>{{ \Carbon\Carbon::parse($val->created_at)->format('d-M, Y') }}</td>
                          <td><a href="{{ url('/history-transactions/' . $val->id) }}" class="btn btn-sm btn-primary">Transactions ( {{$val->transactions->count()}} )</a></td>
                      </tr>                      
                          @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
      <!-- Custom scripts for all pages-->
      <script>
        const datatablesSimple = document.getElementById('datatablescustomerlist');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
      </script>
           @extends('layouts.footer')

    </div>
  </body>
</html>
