<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
                $inversiones = DB::table('inversions')
                                ->select('invertido',
                                         'iduser',
                                         'id')
                                ->get();


             $inversiones = $inversiones->map(function($inversion ){
             $inversion->limite = $inversion->invertido  * 2; //obtener el 200% porciento de la inversion el cual sera el limite

             $rangoporcentage = collect([0.60 , 0.75, ]);



             $inversion->ganancias = $inversion->invertido *  $rangoporcentage->random();
             $inversion->progreso = ($inversion->ganancias / $inversion->limite)*100 ;

              if( $inversion->ganancias  > $inversion->limite || $inversion->progreso > 100 ){

               $inversion->ganancias = $inversion->limite;
               $inversion->progreso = 100  ;
               return $inversion;
              }

             DB::table('inversions')->insert([
                'limite'=> $inversion['limite'],
                'progreso'=> $inversion['progreso'],
                'ganancias'=> $inversion['ganancias'],
             ]);
             return $inversion;
             });


             logger("probando cron");
              })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
