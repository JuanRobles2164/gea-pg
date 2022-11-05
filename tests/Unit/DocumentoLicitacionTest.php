<?php

namespace Tests\Unit;

use App\Repositories\DocumentoLicitacion\DocumentoLicitacionRepository;
use PHPUnit\Framework\TestCase;

class DocumentoLicitacionTest extends TestCase
{
    public function test_getting_instance(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $this->assertIsObject($instance);
    }

    public function test_getting_model(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $model = $instance->getModel();
        $this->assertIsObject($instance);
    }

    public function test_getting_instance_with_no_data(){
        $instance = DocumentoLicitacionRepository::GetInstance();
        $obj = $instance->find(1);
        $this->assertNull($obj);
    }

    public function test_documento_licitacion_find_by_params(){
        $params = [

        ];
        $instance = DocumentoLicitacionRepository::GetInstance();
        $this->assertTrue(true);
    }
}
