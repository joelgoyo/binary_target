<?php

use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Wallet::factory()->count(20)->create();
    }
}
