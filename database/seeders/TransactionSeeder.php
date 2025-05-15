<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transation')->insert([
            'cust_id'         => "2",
            'total_amount'    =>"500.00",
            'ip_address'        => '127.0.0.1',
            'date'  => "2025-05-14",
            'status'     => "Credit",
            'credit_amount'=>'500.00',
            'debit_amount'=>'0.00'
        ]);

        DB::table('transation')->insert([
            'cust_id'         => "2",
            'total_amount'    =>"495.00",
            'ip_address'        => '127.0.0.1',
            'date'  => "2025-05-14",
            'status'     => "Debit",
            'credit_amount'=>'0.00',
            'debit_amount'=>'5.00'
        ]);

    }
}
