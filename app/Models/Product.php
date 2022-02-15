<?php

namespace App\Models;

class Product{
        
    private $Product_id;
    private $Name;
    private $Description;
    private $Price_Root;
    private $Sale_Type;
    private $price_Sale;
    private $Rating;
    private $Quantity;
    private $Sold_Product_Quantity;
    private $Avatar;
    private $Image;
    private $Size;

    public function __construct($id, $Name, $Description, $Price_Root, $Sale_Type,$price_Sale,$Rating,$Quantity,$Sold_Product_Quantity,$Avatar,$Image, $Size)
    {
            $this->Product_id       = $id;
            $this->Name             = $Name;
            $this->Description      = $Description;
            $this->Price_Root       = $Price_Root;
            $this->Sale_Type        = $Sale_Type;
            $this->price_Sale       = $price_Sale;
            $this->Rating           = $Rating;
            $this->Quantity         = $Quantity;
            $this->Sold_Product_Quantity = $Sold_Product_Quantity;
            $this->Avatar           = $Avatar;
            $this->Image            = $Image;
            $this->Size            = $Size;
    }
    
    public function getCurrentPrice(){
            switch(strtolower($this->getSale_Type())){
                    case null:
                    case "normal":
                            return $this->getPrice_Root(); 
                    case "percent": {
                            return  (($this->getPrice_Root() * (100-$this->getprice_Sale())) / 100 );
                    }
                    case "direct": {
                            return $this->getPrice_Root() - $this->getprice_Sale();
                    }
            }
    }

    
        public function getId(){
                return $this->Product_id;
        }
        public function getName(){
                return $this->Name;
        }
        public function getDescription(){
                return $this->Description;
        }
        public function getPrice_Root(){
                return $this->Price_Root;
        }
        public function getSale_Type(){
                return $this->Sale_Type;
        }
        public function getprice_Sale(){
                return $this->price_Sale;
        }
        public function getQuantity(){
                return $this->Quantity;
        }
        public function getRating(){
                return $this->Rating;
        }
        public function getAvatar(){
                return $this->Avatar;
        }
        public function getSold_Product_Quantity(){
                return $this->Sold_Product_Quantity;
        }
        public function getImage(){
                return $this->Image;
        }
        public function getSize(){
                return $this->Size;
        }

    public function setId($id){
            $this->Product_id = $id;
            return $this;
    }
    public function setName($Name){
            $this->Name = $Name;
            return $this;
    }
    public function setDescription($Description){
                $this->Description = $Description;

            return $this;
    }
    public function setPrice_Root($Price_Root){
            $this->Price_Root = $Price_Root;
            return $this;
    }
    public function setSale_Type($Sale_Type){
            $this->Sale_Type = $Sale_Type;
            return $this;
    }
    public function setprice_Sale($price_Sale){
            $this->price_Sale = $price_Sale;
            return $this;
    }
    public function setQuantity($Quantity){
            $this->Quantity = $Quantity;
            return $this;
    }    
    public function setRating($Rating){
            $this->Rating = $Rating;
            return $this;
    }    
    public function setAvatar($Avatar){
            $this->Avatar = $Avatar;
            return $this;
    }    
    public function setSold_Product_Quantity($Sold_Product_Quantity){
            $this->Sold_Product_Quantity = $Sold_Product_Quantity;
            return $this;
    }    
    public function setImage($Image){
            $this->Image = $Image;
            return $this;
    }
    public function setSize($Size){
        $this->Size = $Size;
        return $this;
    }
}

?>
