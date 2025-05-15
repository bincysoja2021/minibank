<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Hash;
use Auth;

class CustomerController extends Controller
{
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
            $cust_list=User::with('transactions')->orderBy('id','desc')->get();
        }
        else
        {
            $cust_list=User::where('id',$loggid)->with('transactions')->orderBy('id','desc')->get();
        }
        return view('customer.index',compact('cust_list'));
    
    }

    public function add_customer()
    {
        return view('customer.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,contact_num',
             'password' => 'required|string|min:8|confirmed',
        ]);
        
        User::create([
            'name' => $request->firstName .' '. $request->lastName,
            'email'=>$request->email,
            'contact_num'=>$request->phone,
            'password'=>Hash::make($request->password),
            'user_type'=>"Customer"
        ]);

        return redirect()->route('list_customer')->with('success','Customer has been created successfully.');
    }

    
    public function history_transactions(Request $req)
    {
       $cust_list=User::with('transactions')->where('id',$req->id)->first();
       $transaction_list=Transaction::where('cust_id',$cust_list->id)->get();
       $balance_amount=Transaction::where('cust_id',$cust_list->id)->latest()->first();
       return view('customer.history_transaction',compact('cust_list','transaction_list','balance_amount'));

    }

       
}
