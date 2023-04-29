<?php

namespace App\Jobs;

use App\Repositories\Documento\DocumentoRepository;
use App\Repositories\Licitacion\LicitacionRepository;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarcarDocumentosVencidos implements ShouldQueue
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
        $this->repo = DocumentoRepository::GetInstance();
        $documentos = $this->repo->listarDocumentosActivosVencidos();
        foreach($documentos as $doc){
            //Se pone en inactivo
            $doc->estado = 2;
            $doc->save();
        }
    }
}
