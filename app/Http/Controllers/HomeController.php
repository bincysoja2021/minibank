<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Auth;
use DB;

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
        
        if (Auth::user()->user_type == "Admin") 
        {
            $usercount = User::count();
            $latestTransactions = Transaction::select('cust_id', DB::raw('MAX(id) as latest_id'))
            ->groupBy('cust_id');
            $Transactioncount = Transaction::joinSub($latestTransactions, 'latest', function ($join) {
            $join->on('transation.id', '=', 'latest.latest_id');
            })->sum('transation.total_amount');
        } 
        else
        {
            $usercount = User::where('id',$loggid)->count();
            $translist=Transaction::where('cust_id',$loggid)->orderBy('id','DESC')->first();
            $Transactioncount=$translist->total_amount;
        }
        
        return view('home',compact('usercount','Transactioncount'));
    }
}
