<?php
namespace App\Repositories;

abstract class BaseRepository{
    private static $instance;
    private function __construct(){

    }

    //Abstract Operations
    abstract public function getModel();

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