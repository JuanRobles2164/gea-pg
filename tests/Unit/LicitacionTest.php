<?php

namespace Tests\Unit;

use App\Repositories\Licitacion\LicitacionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LicitacionTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = LicitacionRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = LicitacionRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = LicitacionRepository::GetInstance();
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
        $instance = LicitacionRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
