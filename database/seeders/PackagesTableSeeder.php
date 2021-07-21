<?php

use App\Models\Packages;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            Packages::create([
                'name' => 'Paquete 100',
                'price' => 100,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 500',
                'price' => 500,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 1.000',
                'price' => 1000,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 3.000',
                'price' => 3000,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 5.000',
                'price' => 5000,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 10.000',
                'price' => 10000,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 20.000',
                'price' => 20000,
                'status' => '1',
            ]);
            Packages::create([
                'name' => 'Paquete 50.000',
                'price' => 50000,
                'status' => '1',
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
