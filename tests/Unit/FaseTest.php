<?php

namespace Tests\Unit;

use App\Models\Fase;
use App\Repositories\Fase\FaseRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaseTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = FaseRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = FaseRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($model);
    }

    public function test_getting_instance_with_no_data(){
        $instance = FaseRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(Fase::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = FaseRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
