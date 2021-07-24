<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Models\OrdenPurchases;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\InversionController;
use Hexters\CoinPayment\CoinPayment;
use Hexters\CoinPayment\Helpers\CoinPaymentHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\shopmail;
use App\Mail\PaymentMail;

class TiendaController extends Controller
{

       
    /**
     * Lleva a la vista de la tienda
     *
     * @return void
     */ 
    public function index()
    {
       
            // title
            View::share('titleg', 'Tienda');
            $invertido = User::find(Auth::user()->id)->getUserInversiones->where('status', 1)->sortBy('invertido')->last();
            // dd($invertido); 
            $packages = Packages::orderBy('id', 'desc')->paginate();
             $invertido = Auth::user()->inversionMasAlta();
            if(isset($invertido)){
                $invertido = $invertido->invertido;
            }
            
            return view('shop.index', compact('packages', 'invertido'));
       
    }



    public function ordenHistory()
    {
        try {
            // title
            // View::sxhare('titleg', 'Tienda - Grupos');

            $ordenes = OrdenPurchases::all()->where('iduser', '=', Auth::user()->id);

            
            return view('shop.orderhistory', compact('ordenes'));
        } catch (\Throwable $th) {
            // Log::error('Tienda - Index -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }



    /**
     * Lleva a la vista de productos de un paquete en especificio
     *
     * @param integer $idpackage
     * @return void
     */
    public function products($idpackage)
    {
        try {
            // title
            View::share('titleg', 'Tienda - Productos');
            $package = Packages::find($idpackage);
            // $category = Packages::find($idpackage);
            // $services = $category->getPackage->where('status', 1);
            dd($package);
            return view('shop.products', compact('package'));
        } catch (\Throwable $th) {
            Log::error('Tienda - products -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permiete procesar la orden de compra
     *
     * @param Request $request
     * @return void
     */
    /////////////////////////////////////////////////////////////////////////////////////////////////
    // public function procesarOrden(Request $request)
    // {
    //     $validate = $request->validate([
    //         'idproduct' => 'required'
    //     ]);
        
    //     //try {
    //         if ($validate) {
    //             $paquete = Packages::find($request->idproduct);
    //             $inv = User::find(Auth::user()->id)->getUserInversiones->where('status', 1)->sortBy('invertido')->last();
    //             if(isset($inv->invertido)){
                    
    //                 $inversion = $inv;
    //                 $pagado = $inversion->invertido;
                    
    //                 $nuevoInvertido = ($paquete->price - $pagado); 
    //                 $porcentaje = ($nuevoInvertido * 0.03);
                    
    //                 $total = ($nuevoInvertido + $porcentaje);
    //                 //ACTUALIZAMOS LA INVERSION
    //                 /*
    //                 $inversion->invertido += $nuevoInvertido;
    //                 $inversion->capital += $nuevoInvertido;
    //                 $inversion->max_ganancia = $inversion->invertido * 2;
    //                 $inversion->restante += $nuevoInvertido * 2;
    //                 $inversion->save();
    //                 */
    //                 $data = [
    //                     'iduser' => Auth::id(),
    //                     'package_id' => $paquete->id,
    //                     'cantidad' => 1,
    //                     'total' => $total,
    //                     'monto' => $nuevoInvertido
    //                 ];
                
    //                 //$orden = OrdenPurchases::findOrFail($inversion->orden_id)->update($data);
    //                 $data['idorden'] = $this->saveOrden($data);
    //                 $data['descripcion'] = "Upgrade al paquete " . $paquete->name;
    //                 //$data['inversion_id'] = $inversion->id;  
                    
    //             }else{
    //                 $porcentaje = ($paquete->price * 0.03);

    //                 $total = ($paquete->price + $porcentaje);
    //                 $data = [
    //                     'iduser' => Auth::id(),
    //                     'package_id' => $paquete->id,
    //                     'cantidad' => 1,
    //                     'total' => $total,
    //                     'monto' => $paquete->price
    //                 ];
                    
    //                 $data['idorden'] = $this->saveOrden($data);
    //                 $data['descripcion'] = $paquete->description;    
    //             }
                
                
               

    //             $url = $this->generalUrlOrden($data);
    //         //    dd($url);
    //             if (!empty($url)) {
    //                 return redirect($url);

    //             }else{

    //                OrdenPurchases::where('id', $data['idorden'])->delete();
    //                return redirect()->back()->with('msj-info', 'Problemas al general la orden, intente mas tarde');
    //             }


    //         }
    //     /*} catch (\Throwable $th) {
    //         Log::error('Tienda - procesarOrden -> Error: '.$th);
    //         abort(403, "Ocurrio un error (1) , contacte con el administrador");
    //     }*/
    // }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function procesarOrden($id)
    {
        try {
            // dd($id);
            $product = Packages::find($id);
            $user = Auth::user()->id;
            // $data = Order::latest('id')->first();
            // $hayData = $data? $data->id+1 : 1;

            $infoOrden = [
                'iduser' => Auth::user()->id,
                'package_id' => $product->id,
                'total' => $product->price,
                'status' => '0'
            ];

            $transacion = [
                'amountTotal' => $product->price,
                'note' => 'Compra de paquete: '.$product->name.' por un precio de '.$product->price,
                'order_id' => $this->saveOrden($infoOrden),
                'tipo' => 'Compra de un paquete',
                'tipo_transacion' => 3,
                'buyer_name' => Auth::user()->name,
                'buyer_email' => Auth::user()->email,
                'redirect_url' => url('/'),
                'cancel_url' => url('/')
            ];
            $transacion['items'][] = [
                'itemDescription' => 'Compra de paquete '.$product->name,
                'itemPrice' => $product->price, // USD
                'itemQty' => (INT) 1,
                'itemSubtotalAmount' => $product->price // USD
            ];
            // dd($transacion);
            $ruta = CoinPayment::generatelink($transacion);
            // dd($ruta);
            return redirect($ruta);

        } catch (\Throwable $th) {
            Log::error('Tienda - procesarOrden -> Error: '.$th);
            abort(403, "Ocurrio un error (1) , contacte con el administrador");
        }
        // try{
        //     $product = ProductWarehouse::find($id);
        //     $user = Auth::user()->id;
        //     $data = Order::latest('id')->first();
        //     $hayData = $data? $data->id+1 : 1;

        //     $transaction['order_id'] =  $hayData; // invoice number
        //     $transaction['amountTotal'] = (FLOAT) 210;
        //     $transaction['note'] = "Compra de Producto";
        //     $transaction['buyer_name'] = Auth::user()->firstname;
        //     $transaction['buyer_email'] = Auth::user()->email;
        //     $transaction['redirect_url'] = url('/'); // When Transaction was comleted
        //     $transaction['cancel_url'] = url('/'); // When user click cancel link

        //     $transaction['items'][] = [
        //         'itemDescription' => $product->name,
        //         'itemPrice' => (FLOAT) $product->price, // USD
        //         'itemQty' => (INT) 1,
        //         'itemSubtotalAmount' => (FLOAT) $product->price*1 // USD
        //       ];

        //     $transaction['payload'] = [
        //         'foo' => [
        //        'bar' => 'baz'
        //     ]
        //  ];


        //     return redirect(CoinPayment::generatelink($transaction));
        // } catch (\Throwable $th) {
        //     Log::error('LinkCoinpayment -> '.$th);
        // }  

    }


    /**
     * Guarda la informacion de las ordenes nuevas 
     *
     * @param array $data
     * @return integer
     */
    public function saveOrden($data): int
    {
        $orden = OrdenPurchases::create($data);
        return $orden->id;
    }

    /**
     * Notifica el estado de la compra una vez realizada
     *
     * @param integer $orden
     * @param string $status
     * @return void
     */
    public function statusProcess($orden, $status)
    {
        $type = ($status == 'Completada') ? 'success' : 'danger';
        $msj = 'Compra '.$status;

        if ($status == 'Completada') {
            $this->registeInversion($orden);
        }
        
        return redirect()->route('shop')->with('msj-'.$type, $msj);
    }

    /**
     * Permite Registrar las ordenes de forma manual
     *
     * @return void
     */
    public function getOrdenes()
    {
        $ordenes = OrdenPurchases::all()->where('status', '1');
        foreach ($ordenes as $orden) {
            $this->registeInversion($orden->id);
        }
    }

    /**
     * Permite llamar al funcion que registra las inversiones
     *
     * @param integer $idorden
     * @return void
     */
    private function registeInversion($idorden)
    {
        $orden = OrdenPurchases::find($idorden);
        $paquete = $orden->getPackageOrden;
        $this->inversionController->saveInversion($paquete->id, $idorden, $orden->cantidad, $paquete->expired, $orden->iduser);
    }

    /**
     * Permite recibir el estado de las ordenes 
     *
     * @param Request $resquet
     * @return void
     */
    public function ipn(Request $resquet)
    { 
        Log::info('ipn prueba ->', $resquet);
    }

    /**
     * Permite general el url para pagar la compra
     *
     * @param array $data
     * @return string
     */
    private function generalUrlOrden($data): string
    {
       try {
            $headers = [
                'x-api-key: '.$this->apis_key_nowpayments,
                'Content-Type:application/json'
            ];

            $resul = ''; 
            $curl = curl_init();

            $dataRaw = collect([
                'price_amount' => floatval($data['total']),
                "price_currency" => "usd",
                "order_id" => $data['idorden'],
                'pay_currency' => 'USDTTRC20',
                "order_description" => $data['descripcion'],
                "ipn_callback_url" => route('shop.ipn'),
                "success_url" => route('shop.proceso.status', [$data['idorden'], 'Completada']),
                "cancel_url" => route('shop.proceso.status', [$data['idorden'], 'Cancelada']),
                //"Amount" => $data['Amount']
            ]);
            

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.nowpayments.io/v1/invoice",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $dataRaw->toJson(),
                CURLOPT_HTTPHEADER => $headers
            ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    Log::error('Tienda - generalUrlOrden -> Error curl: '.$err);        
                } else {
                    $response = json_decode($response);
                    OrdenPurchases::where('id', $data['idorden'])->update(['idtransacion' => $response->id]);
                    $resul = $response->invoice_url;
                }
                  
            return $resul;
        } catch (\Throwable $th) {
            Log::error('Tienda - generalUrlOrden -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cambiar_status(Request $request)
    {
        $orden = OrdenPurchases::findOrFail($request->id);
        $orden->status = $request->status;
        $orden->save();

        $this->registeInversion($request->id);

        return redirect()->back()->with('msj-success', 'Orden actualizada exitosamente');
    }
}
