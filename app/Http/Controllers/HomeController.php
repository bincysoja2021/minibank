<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $loggid=Auth::user()->id;
        if(Auth::user()->user_type=="Admin")
        {
            $usercount = User::count();
            $Transactioncount=Transaction::sum('total_amount');
        }
        else
        {
            $usercount = User::where('id',$loggid)->count();
            $Transactioncount=Transaction::where('cust_id',$loggid)->sum('total_amount');
        }
        
        return view('home',compact('usercount','Transactioncount'));
    }
}
