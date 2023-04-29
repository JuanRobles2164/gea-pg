<?php

namespace App\Jobs;

use App\Repositories\Licitacion\LicitacionRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MarcarLicitacionesVencidas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $repo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->repo = LicitacionRepository::GetInstance();
        $licitaciones = $this->repo->getAllLicitacionesPorVencer();
        foreach($licitaciones as $lic){
            $carbonFecha = Carbon::parse($lic->fecha_fin);
            if($carbonFecha->isPast()){
                $lic->estado = 9;
                $lic->save();
            }
        }
    }
}
