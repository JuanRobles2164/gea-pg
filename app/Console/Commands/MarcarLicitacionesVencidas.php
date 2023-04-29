<?php

namespace App\Console\Commands;

use App\Repositories\Licitacion\LicitacionRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarcarLicitacionesVencidas extends Command
{
    private $repo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gea:marcar_licitaciones_vencidas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
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
        
        return 0;
    }
}
