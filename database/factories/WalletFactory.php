<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrdenPurchases;
use App\Models\User;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $orden = OrdenPurchases::all()->random();
        $user = User::all()->random();

        return [
            'iduser' => $user->id, 
            'referred_id' => $user->id,
            'orden_purchase_id' => $orden->id,
            'monto' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0), 
            'descripcion' => $this->faker->text,
            'status' => '0',
            'tipo_transaction' => '0',
            'liquidado' => '0',

        ];
    }
}
