<?php

namespace Database\Factories;

use App\Models\OrdenPurchases;
use App\Models\Packages;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrdenPurchasesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrdenPurchases::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();
        $paquete = Packages::all()->random();
        return [
            'iduser' => $user->id, 
            'package_id' => $paquete->id,
            'cantidad' => 1, 
            'total' => $paquete->price,
            'status' => '1'
        ];
    }
}
