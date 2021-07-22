<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            User::create([
                'name' => 'Admin',
                'last_name' => 'Binary Stage',
                'fullname' => 'Admin Binary Stage',
                'email' => 'admin@binarystage.com',
                'admin' => '1',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 0,
            ]);

            User::create([
                'name' => 'User',
                'last_name' => 'Binary Stage',
                'fullname' => 'User Binary Stage',
                'email' => 'user@binarystage.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 1,
            ]);
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
