<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class LoadTag{
        
    private $Tags = array();
    
    
    public function getTags(){
        return $this->Tags;
    }

    public function setTags($tags){
        $this->Tags[] = $tags;
        return $this;
    }

    public function __construct()
    {
        $tableTag = DB::table('tags')->get();
        $tableTagProduct = DB::table('product_tag')->get();

        foreach($tableTag as $table1){ 
            $product_code = array();
            foreach($tableTagProduct as $table2){
                if($table2->Tag_id == $table1->Tag_id){
                    $product_code[] = $table2->Product_id;
                }
            }
                $tags = new Tag($table1->Tag_id, $table1->NAME, $product_code);
                $this->setTags($tags);
        }
    }
}

    


?>
