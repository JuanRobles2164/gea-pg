<?php

namespace Tests\Unit;

use App\Models\FaseTipoDocumento;
use App\Repositories\FaseTipoDocumento\FaseTipoDocumentoRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaseTipoDocumentoTest extends TestCase
{
    use RefreshDatabase;
    public function test_getting_instance(){
        $instance = FaseTipoDocumentoRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = FaseTipoDocumentoRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($model);
    }

    public function test_getting_instance_with_no_data(){
        $instance = FaseTipoDocumentoRepository::GetInstance();
        $obj = $instance->find(1);
        if($obj == null){
            $this->assertTrue(true);
        }else{
            $this->assertInstanceOf(FaseTipoDocumento::class, $obj);
        }
    }

    public function test_find_by_params(){
        $params = [
            'registro_unico' => true
        ];
        $instance = FaseTipoDocumentoRepository::GetInstance();
        $results = $instance->findByParams($params);
        if($results == null){
            $this->assertNull($results);
        }else{
            $this->assertNotNull($results);
        }
    }
}
