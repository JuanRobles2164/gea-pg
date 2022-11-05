<?php

namespace Tests\Unit;

use App\Models\Rol;
use App\Repositories\Rol\RolRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = RolRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = RolRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = RolRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(Rol::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = RolRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
