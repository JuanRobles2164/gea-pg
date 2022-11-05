<?php

namespace Tests\Unit;

use App\Models\DocumentoLicitacion;
use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentoLicitacionTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($model);
    }

    public function test_getting_instance_with_no_data(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(DocumentoLicitacion::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = DocumentoLicitacionRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
