<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->date('date')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('status', ['Credit', 'Debit']);
            $table->decimal('credit_amount', 10, 2);
            $table->decimal('debit_amount', 10, 2);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transation');
    }
}
