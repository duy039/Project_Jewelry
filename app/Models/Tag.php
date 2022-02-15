<?php

namespace App\Models;

class Tag{
        
    private $id;
    private $name;
    private $product_id;

    public function __construct($id, $name,  $product_id){
            $this->id               = $id;
            $this->name             = $name;
            $this->product_id       = $product_id;
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getProduct_id(){
        return $this->product_id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    public function setProduct_id($product_id){
        $this->product_id = $product_id;
        return $this;
    }

}