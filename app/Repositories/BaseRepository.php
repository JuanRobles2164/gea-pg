<?php
namespace App\Repositories;

abstract class BaseRepository{
    private static $instance;
    private const ACTIVO = 1;
    private const INACTIVO = 2;
    private function __construct(){

    }

    //Abstract Operations
    abstract public function getModel();

    /**
     * Dependiendo de los valores que tenga este array, se buscará bajo ciertos criterios u otros
     * @param array $params arreglo de parámetros
     * @return Illuminate\Database\Eloquent\Collection
     */
    abstract public function findByParams($params);
    
    public function firstOrCreate($params){
        return $this->getModel()->firstOrCreate($params);
    }
    //Create Operations
    public function create($object){
        return $this->getModel()->create($object);
    }
    //Read Operations
    public function find($id){
        return $this->getModel()->find($id);
    }
    public function getAll($paginate = 15){
        return $this->getModel()->paginate($paginate);
    }
    //Trae un listado de todos las entidades no eliminadas
    public function getAllEstado($paginate = 15, $estado = 3){
        return $this->getModel()->where("estado", "!=", $estado)->paginate($paginate);
    }
    //Trae un listado de todos las entidades activas
    public function getAllActivos($paginate = 15, $estado = 1){
        return $this->getModel()->where("estado", $estado)->paginate($paginate);
    }
    //Update Operations
    public function update($object, $data){
        $object->fill($data);
        $object->save();
        return $object;
    }

    //Delete Operations
    public function delete($object){
        $object->delete();
    }
}