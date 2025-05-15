<?php 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Validator;

class TransactionController extends Controller
{
    public $successStatus = 200;

    public function add_transaction(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:0.01',
        ]);
        if ($validator->fails()) {
            $errors  = json_decode($validator->errors());
            $type   =isset($errors->type[0])? $errors->type[0] : '';
            $amount=isset($errors->amount[0])? $errors->amount[0] : '';

            if($type){
              $msg = $type;
            }else if($amount){
              $msg = $amount;
            }
            
            return response()->json(['message' =>$validator->errors(),'data'=>[],'statusCode'=>422,'success'=>'error'],422);
        }

        $user = $request->user();
        $transaction=Transaction::where('cust_id',$user->id)->latest()->first();
        $current_balance = $transaction ? $transaction->total_amount : 0;

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
            $trans_totalamount=$current_balance + $request->amount;
        }
        else
        {
            $trans_totalamount=$current_balance - $request->amount;
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
