<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\MailResetPasswordNotification as ResetPasswordNotification;


class User extends Authenticatable

{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'username', 'email', 'password', 'whatsapp',
        'fullname', 'referred_id', 'binary_id', 'admin', 'balance', 'status',
        'wallet', 'address', 'binary_side', 'binary_side_register', 'dni',
        'photoDB', 'wallet_address', 'point_rank', 'rank_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ]; 



    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany('App\Models\Wallet', 'iduser');
    }

    /**
     * Permite obtener todas la liquidaciones que tengo
     *
     * @return void
     */
    public function getLiquidate()
    {
        return $this->hasMany('App\Models\Liquidaction', 'iduser');
    }

    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void 
     */
    public function getUserOrden()
    {
        return $this->belongsTo('App\Models\OrdenPurchases', 'id', 'iduser');
    }

    public function getUserInversiones()
    {
        return $this->hasMany('App\Models\Inversion', 'iduser');
    }

    public function inversionMasAlta()
    {
        return $this->getUserInversiones()->where('status', 1)->orderBy('invertido', 'desc')->first();
        //->sortByDesc('invertido')
    }

    public function montoInvertido()
    {
        $monto = 0;
        foreach($this->getUserInversiones as $inversion){
            if($inversion->status == 1){
                $monto+= $inversion->invertido;
            }
        }
        return number_format($monto,2);
    }

    public function saldoDisponible()
    {
        return number_format($this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('monto'), 2);
    }

    public function gananciaActual()
    {   
        if(isset($this->inversionMasAlta()->ganacia) && $this->inversionMasAlta()->ganacia != null){
            return number_format($this->inversionMasAlta()->ganacia, 2);
        }else{
            return number_format(0, 2);
        }
        
    }

    public function progreso()
    {
        if(isset($this->inversionMasAlta()->max_ganancia) && isset($this->inversionMasAlta()->restante)){
            $total = $this->inversionMasAlta()->max_ganancia - $this->inversionMasAlta()->restante;

            if($this->inversionMasAlta()->max_ganancia != null && $this->inversionMasAlta()->max_ganancia != 0){
                $operacion = ($total * 100) / $this->inversionMasAlta()->max_ganancia;
            }else{
                $operacion = 0;
            }
        }else{
            $operacion = 0;
        }
        return $operacion;
    }

    public function fechaActivo()
    {
        if($this->inversionMasAlta() != null){
            return $this->inversionMasAlta()->created_at->format('Y-m-d');
        }else{
            return "";
        }
    }
}
