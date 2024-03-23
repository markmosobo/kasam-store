<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_no')->nullable();
            $table->integer('items_no')->nullable();
            $table->integer('status');
            $table->string('payment_method')->nullable();
            $table->string('mpesa_code')->nullable();
            $table->float('amount_due')->nullable();
            $table->float('amount_paid')->nullable();
            $table->float('change')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
            ->references('id')
            ->on('users');
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
        Schema::dropIfExists('invoices');
    }
};
