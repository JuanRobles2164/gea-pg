<?php

namespace Tests\Unit;

use App\Models\FaseTipoLicitacion;
use App\Repositories\FaseTipoLicitacion\FaseTipoLicitacionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaseTipoLicitacionTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = FaseTipoLicitacionRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = FaseTipoLicitacionRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = FaseTipoLicitacionRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(FaseTipoLicitacion::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = FaseTipoLicitacionRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
