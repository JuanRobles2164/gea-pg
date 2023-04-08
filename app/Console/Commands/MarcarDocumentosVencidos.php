<?php

namespace App\Console\Commands;

use App\Repositories\Documento\DocumentoRepository;
use Illuminate\Console\Command;

class MarcarDocumentosVencidos extends Command
{
    private $repo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gea:marcar_documentos_vencidos';

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

        $this->repo = DocumentoRepository::GetInstance();
        $documentos = $this->repo->listarDocumentosActivosVencidos();
        foreach($documentos as $doc){
            //Se pone en inactivo
            $doc->estado = 2;
            $doc->save();
        }

        return 0;
    }
}
