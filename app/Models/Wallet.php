<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'iduser', 'referred_id', 'cierre_comision_id', 'liquidation_id', 'monto',
        'descripcion', 'status', 'tipo_transaction',
        'liquidado'
    ];

    /**
     * Permite obtener la orden de esta comision
     *
     * @return void
     */
    public function getWalletComisiones()
    {
        return $this->belongsTo('App\Models\CierreComision', 'cierre_comision_id', 'id');
    }

    /**
     * Permite obtener al usuario de una comision
     *
     * @return void
     */
    public function getWalletUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

    /**
     * Permite obtener al referido de una comision
     *
     * @return void
     */
    public function getWalletReferred()
    {
        return $this->belongsTo('App\Models\User', 'referred_id', 'id');
    }
}
