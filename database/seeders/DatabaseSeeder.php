<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Address::factory(10)->create();
        \App\Models\Product::factory(10)->create();
        \App\Models\Subscriber::factory(10)->create();
        \App\Models\Supplier::factory(10)->create();
        \App\Models\BankAccount::factory(10)->create();
        \App\Models\BankAccount::factory(10)->create();
        \App\Models\Invoice::factory(10)->create();
        \App\Models\InvoiceProduct::factory(20)->create();
    }
}
