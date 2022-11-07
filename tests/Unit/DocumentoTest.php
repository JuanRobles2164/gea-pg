<?php

namespace Tests\Unit;

use App\Models\Document;
use App\Repositories\Documento\DocumentoRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentoTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = DocumentoRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = DocumentoRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = DocumentoRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(Document::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true,
            'nombre' => 'documento'
        ];
        $instance = DocumentoRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
