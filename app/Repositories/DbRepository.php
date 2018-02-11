<?php

namespace App\Repositories;

class DbRepository implements BaseRepository{

    protected $entity;

    public function __construct(){}
    

    public function getAll(){
        return $this->entity->all();
    }

    public function getByid($id){
        return $this->entity->find($id);
    }

    public function create(array $attributes){
        return $this->entity->create($attributes);
    }

    public function update($id,  array $attributes){
        return $this->entity->find($id)->update($attributes);
    }

    public function delete($id){
        return $this->entity->find($id)->delete();
    }

}