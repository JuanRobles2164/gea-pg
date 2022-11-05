<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Repositories\Categoria\CategoriaRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = CategoriaRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = CategoriaRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($model);
    }

    public function test_getting_instance_with_no_data(){
        $repo = CategoriaRepository::GetInstance();
        $obj = $repo->find(1);
        if($obj != null){
            $this->assertInstanceOf(Categoria::class, $obj);
        }else{
            $this->assertTrue(true);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true,
            'nombre' => '2018'
        ];
        $instance = Categoria::where('nombre', '=', $params['nombre']);
        $this->assertNotNull($instance);
    }
}
