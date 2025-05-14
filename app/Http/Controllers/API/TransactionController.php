<?php 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public $successStatus = 200;

    public function add_transaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = $request->user();
        $transaction=Transaction::where('cust_id',$user->id)->latest()->first();

        if ($request->type === 'Debit') 
        {
            $today = Carbon::today();
            $debitCount = Transaction::where('cust_id', $user->id)
                ->where('status', 'Debit')
                ->whereDate('created_at', $today)
                ->count();

            if ($debitCount >= 5) 
            {
                return response()->json(['message' => 'Daily debit limit reached','statusCode'=>403], 403);
            }
            if ($request->amount >= $transaction->total_amount) 
            {
                return response()->json(['message' => 'Insufficiant bank balance.','statusCode'=>403], 403);
            }
        }
        if($request->type === 'Credit')
        {
            $trans_totalamount=$transaction->total_amount + $request->amount;
        }
        else
        {
            $trans_totalamount=$transaction->total_amount - $request->amount;
        }
        
        $transaction = Transaction::create([
            'cust_id' => $user->id,
            'total_amount' => $trans_totalamount,
            'date' => now(),
            'ip_address' => $request->ip(),
            'status' => $request->type,
            'credit_amount' => $request->type === 'Credit' ? $request->amount : 0,
            'debit_amount' => $request->type === 'Debit' ? $request->amount : 0,
        ]);
        return response()->json(['message'=>"{$request->type} successful", 'statusCode' => $this-> successStatus,'transaction'=>$transaction,'success' => 'success'], $this-> successStatus);
    }
}
