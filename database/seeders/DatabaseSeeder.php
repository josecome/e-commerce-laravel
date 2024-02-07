<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Supplier;
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
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::factory(10)->create();
        DB::table('users')->where('id', 1)->update(['email' => 'test@test.com', 'name' => 'Test User', 'role' => 'admin']);
        //DB::table('categories')->where('id', 1)->update(['category' => 'other', 'description' => 'Music without category']);


        $this->call(SupplierSeeder::class);
        $this->call(SupplierPaymentSeeder::class);
        $this->call(ProdCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(OrderDetailsSeeder::class);
        $this->call(ShipperSeeder::class);
        DB::unprepared("update carts set totalprice = qnty * price");
        DB::unprepared("update carts set payment_id = FLOOR(RAND() * (200-100) + 100)");
    }
}
