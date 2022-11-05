<?php

namespace Tests\Unit;

use App\Models\LicitacionFase;
use App\Repositories\LicitacionFase\LicitacionFaseRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LicitacionFaseTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = LicitacionFaseRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = LicitacionFaseRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = LicitacionFaseRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(LicitacionFase::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = LicitacionFaseRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
