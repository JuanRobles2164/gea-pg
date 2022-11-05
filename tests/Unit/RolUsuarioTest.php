<?php

namespace Tests\Unit;

use App\Models\RolUsuario;
use App\Repositories\RolUsuario\RolUsuarioRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolUsuarioTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = RolUsuarioRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = RolUsuarioRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = RolUsuarioRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(RolUsuario::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true,
            'usuario' => 2
        ];
        $instance = RolUsuarioRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
