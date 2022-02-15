<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class LoadProduct{
        
    private $Products;

    
    public function getProducts(){
        return $this->Products;
    }

    public function setProducts($Product){
        $this->Products = $Product;
        return $this;
    }

    public function __construct()
    {
        $product = array();
        $tableProduct = DB::table('product')->get();
        $tableImageProduct = DB::table('images_product')->get();
        $tableSize = DB::table('size')->get();
        $i = 0;
        foreach($tableProduct as $table){
            $images = array();
            $size = array();
            foreach($tableImageProduct as $table2){
                if($table2->Product_id === $table->Product_id){
                    $images[] = $table2->Image_Name;
                }
            }
            foreach($tableSize as $table3){
                if($table3->Product_id === $table->Product_id){
                    $size[] = $table3->Size;
                }
            }
            $product[$i] = new Product($table->Product_id, $table->Name, $table->Description, $table->Price_Root, $table->Sale_Type, $table->Price_Sale, $table->Rating, $table->Quantity, $table->Sold_Product_Quantity, $table->Avatar, $images, $size);
            $i++;
            
        }
        $this->setProducts($product);
    }

    
}

?>
