<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class TicketsController extends Controller
{

    // permite ver la vista de creacion del ticket


    public function create(){

      return view('tickets.create');



    }

    // permite la creacion del ticket

    public function store(Request $request){

        $fields = [
            "issue" => ['required'],
            'status' => ['0'],
            "note" => ['required'],
        ];

        $msj = [

            'issue.required' => 'El asunto es Requerido',
            'note.required' => 'El mensaje es Requerido',

        ];

        $this->validate($request, $fields, $msj);

        Ticket::create([
            'iduser' => Auth::id(),
            'issue' => request('issue'),
            'note' => request('note'),

        ]);

        return redirect()->route('ticket.list-user')->with('msj-success', 'El Ticket se creo Exitosamente');
    }

    // permite editar el ticket

    public function editUser($id){

        $ticket = Ticket::find($id);

        return view('tickets.componenteTickets.user.edit-user')
        ->with('ticket', $ticket);
    }

    // permite actualizar el ticket

    public function updateUser(Request $request, $id){

        $ticket = Ticket::find($id);

        $fields = [


            'status' => ['0'],
            "note" => ['required'],
            "issue" => ['required'],


        ];

        $msj = [

             'issue.required' => 'el asunto es Requerido',
             'note.required' => 'La mensaje es Requerido',

        ];

        $this->validate($request, $fields, $msj);

        $ticket->update($request->all());
        // $ticket->note_admin = $request->note_admin;
        $ticket->save();

        $route = route('ticket.list-user');
        return redirect($route)->with('msj-success', 'Ticket '.$id.' Actualizado ');
    }

    // permite ver la lista de tickets

    public function listUser(Request $request){

        $ticket = Ticket::where('iduser', Auth::id())->get();

        View::share('titleg', 'Historial de Tickets');

        return view('tickets.componenteTickets.user.list-user')
        ->with('ticket', $ticket);
    }

    // permite ver el ticket

    public function showUser($id){

        $ticket = Ticket::find($id);

        return view('tickets.componenteTickets.user.show-user')
        ->with('ticket', $ticket);
    }




    // permite editar el ticket

    public function editAdmin($id){

        $ticket = Ticket::find($id);

        return view('tickets.componenteTickets.admin.edit-admin')
        ->with('ticket', $ticket);
    }

    // permite actualizar el ticket

    public function updateAdmin(Request $request, $id){

        $ticket = Ticket::find($id);

        $fields = [
            'status' => ['required'],
            // 'note_admin' => ['required'],
            'note' => ['required'],
        ];

        $msj = [
            'status.required' => 'Es requerido el Estatus de la ticket',
            // 'note_admin.required' => 'Es requerido Nota del admin',
            'note.required' => 'Es requerido mensaje del admin',
        ];

        $this->validate($request, $fields, $msj);

        $ticket->update($request->all());
        // $ticket->note_admin = $request->note_admin;
        $ticket->save();

        $route = route('ticket.list-admin');
        return redirect($route)->with('msj-success', 'Ticket '.$id.' Actualizado ');
    }

    // permite ver la lista de tickets

    public function listAdmin(){

        $ticket = Ticket::all();

        View::share('titleg', 'Historial de Tickets');

        return view('tickets.componenteTickets.admin.list-admin')
        ->with('ticket', $ticket);
    }

    // permite ver el ticket

    public function showAdmin($id){

        $ticket = Ticket::find($id);

        return view('tickets.componenteTickets.admin.show-admin')
        ->with('ticket', $ticket);
    }










    /**
     * Permite obtener la cantidad de Tickets que tiene un usuario
     *
     * @param integer $iduser
     * @return integer
     */
    public function getTotalTickets($iduser): int
    {
        try {
            $Tickets = Ticket::where('iduser', $iduser)->get()->count('id');
            if ($iduser == 1) {
                $Tickets = Ticket::all()->count('id');
            }
            return $Tickets;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Permite obtener el total de Tickets por meses
     *
     * @param integer $iduser
     * @return array
     */
    public function getDataGraphiTickets($iduser): array
    {
        try {
            $totalTickets = [];
            if (Auth::user()->admin == 1) {
                $Tickets = Ticket::select(DB::raw('COUNT(id) as Tickets'))
                                ->where([
                                    ['status', '>=', 0]
                                ])
                                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                                ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                                ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                                ->take(6)
                                ->get();
            }else{
                $Tickets = Ticket::select(DB::raw('COUNT(id) as Tickets'))
                                ->where([
                                    ['iduser', '=',  $iduser],
                                    ['status', '>=', 0]
                                ])
                                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                                ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                                ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                                ->take(6)
                                ->get();
            }
            foreach ($Tickets as $ticket) {
                $totalTickets [] = $ticket->Tickets;
            }
            return $totalTickets;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
