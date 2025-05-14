<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transation";
    protected $fillable = [
        'id',
        'cust_id',
        'total_amount',
        'date',
        'ip_address',
        'status',
        'credit_amount',
        'debit_amount'
    ];

}
