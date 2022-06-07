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
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('subscriber_id');
            $table->date('create_date');
            $table->date('due_date');
            $table->timestamps();

            $table->foreign('supplier_id')->on('suppliers')->references('id');
            $table->foreign('subscriber_id')->on('subscribers')->references('id');
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
