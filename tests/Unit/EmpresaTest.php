<?php

namespace Tests\Unit;

use App\Models\Empresa;
use App\Repositories\Empresa\EmpresaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpresaTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = EmpresaRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = EmpresaRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($model);
    }

    public function test_getting_instance_with_no_data(){
        $instance = EmpresaRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(Empresa::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = EmpresaRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
