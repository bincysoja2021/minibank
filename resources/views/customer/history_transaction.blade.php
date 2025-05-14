@extends('layouts.header')

@section('content')
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
          <li class="breadcrumb-item active">Transactions</li>
        </ol>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div>
                  <h5>Listing Transactions of <b>{{$cust_list->name}}</b></h5>
                  <p>Balance : $ {{$cust_list->transactions->sum('total_amount')}}</p>
                </div>
                <div>
                  <a href="{{ url ('/list-customer')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Customers</a>
                </div>
              </div>
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                      <tr>
                          <th>Type</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>ip</th>                         
                      </tr>
                  </thead>            
                  <tbody>
                    @foreach($transaction_list as $val)
                      <tr>
                          <td>{{$val->status}}</td>
                          <td>{{ \Carbon\Carbon::parse($val->date)->format('d-M, Y') }}</td>
                          @if($val->status == "Credit")
                          <td>$ {{$val->credit_amount}}</td>
                          @else
                          <td>$ {{$val->debit_amount}}</td>
                          @endif
                          <td>{{$val->ip_address}}</td>
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
      <script src="js/sb-admin.min.js"></script>
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
