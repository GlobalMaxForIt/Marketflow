<?php

namespace App\Service;


use Illuminate\Http\Request;

class SaveImages
{
    public function imageSave($model, $images, $text, $images_directory){
        if($text == 'update'){
            if($model->images && !is_array($model->images)){
                $product_images = json_decode($model->images);
            }else{
                $product_images = [];
            }
        }else{
            $product_images = [];
        }
        if(isset($images)){
            $ProductImage = [];
            foreach($images as $image){
                $random = $this->setRandom();
                $product_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
                $image->storeAs("public/$images_directory/", $product_image_name);
                $ProductImage[] = $product_image_name;
            }
            $all_product_images = array_values(array_merge($product_images, $ProductImage));
        }
        $productImages = json_encode($all_product_images??$product_images);
        return $productImages;
    }

    public function setRandom(){
        $letters = range('a', 'z');
        $random_array = [$letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)]];
        $random = implode("", $random_array);
        return $random;
    }
}
