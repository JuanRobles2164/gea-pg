<?php

namespace App\Console;

use App\Jobs\MarcarDocumentosVencidos;
use App\Jobs\MarcarLicitacionesVencidas;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();
        $schedule->command('gea:marcar_documentos_vencidos')->daily();
        $schedule->command('gea:marcar_licitaciones_vencidas')->daily();
        $schedule->job(MarcarDocumentosVencidos::class)->dailyAt('00:00');
        $schedule->job(MarcarLicitacionesVencidas::class)->dailyAt('00:00');
        
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
