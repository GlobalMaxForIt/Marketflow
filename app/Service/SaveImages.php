<?php

namespace App\Service;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;

class SaveImages
{
    public function imageSave($model, $images, $text, $images_directory){
        $lang = App::getLocale();
        if($text == 'update'){
            if($model->images && !is_array($model->images)){
                $product_images = json_decode($model->images);
            }else{
                $product_images = [];
            }
        }else{
            $product_images = [];
        }
        $mb = 1024 * 1024;
        $shrink_percent = 100;
        if (isset($images)) {

            // Tasvirni olish
            $ProductImage = [];
            foreach ($images as $image) {
                $image_size = $image->getSize();

                // Shrink parameter logic
                if ($image_size > 14 * $mb && $image_size <= 15 * $mb) {
                    $shrink_percent = 3.33;
                } elseif ($image_size > 13 * $mb && $image_size <= 14 * $mb) {
                    $shrink_percent = 3.57;
                } elseif ($image_size > 12 * $mb && $image_size <= 13 * $mb) {
                    $shrink_percent = 3.85;
                } elseif ($image_size > 11 * $mb && $image_size <= 12 * $mb) {
                    $shrink_percent = 4.16;
                } elseif ($image_size > 10 * $mb && $image_size <= 11 * $mb) {
                    $shrink_percent = 4.55;
                } elseif ($image_size > 9 * $mb && $image_size <= 10 * $mb) {
                    $shrink_percent = 5;
                } elseif ($image_size > 8 * $mb && $image_size <= 9 * $mb) {
                    $shrink_percent = 5.56;
                } elseif ($image_size > 7 * $mb && $image_size <= 8 * $mb) {
                    $shrink_percent = 6.25;
                } elseif ($image_size > 6 * $mb && $image_size <= 7 * $mb) {
                    $shrink_percent = 7.14;
                } elseif ($image_size > 5 * $mb && $image_size <= 6 * $mb) {
                    $shrink_percent = 8.33;
                } elseif ($image_size > 4 * $mb && $image_size <= 5 * $mb) {
                    $shrink_percent = 10;
                } elseif ($image_size > 3 * $mb && $image_size <= 4 * $mb) {
                    $shrink_percent = 12.5;
                } elseif ($image_size > 2 * $mb && $image_size <= 3 * $mb) {
                    $shrink_percent = 16.67;
                } elseif ($image_size > $mb && $image_size <= 2 * $mb) {
                    $shrink_percent = 25;
                } elseif ($image_size > $mb / 2 && $image_size <= $mb) {
                    $shrink_percent = 50;
                } elseif ($image_size > 15 * $mb) {
                    return redirect()->back()->with('error', translate_title('Your image is bigger than 15 MB', $lang));
                } elseif ($image_size <= $mb / 2) {
                    $shrink_percent = 100;
                }

                // Yangi fayl nomini yaratish
                $random = $this->setRandom();
                dd($image, $image->extension());
                $product_image_name = $random . ''. date('Y-m-d_h-i-s') . '.' . $image->extension();
                $img = Image::make($image);
                // Agar kichraytirish parametri mavjud bo'lsa
                if ($shrink_percent <100) {
                    // Sifatni kamaytirish
                   $img->encode($image->extension(), $shrink_percent);  // Sifatni 75% ga kamaytirish
                }

                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Aspekt nisbati saqlanadi
                    $constraint->upsize(); // Rasmni kattalashmaslikka ruxsat berish
                });
                // Tasvirni belgilangan papkaga saqlash
                $path = storage_path('app/public/' . $images_directory);  // Papka yo'li

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);  // Papkani yaratish
                }
                $img->save($path . '/' . $product_image_name);

                // Yangi tasvir nomini ma'lumotlar bazasida saqlash
                $ProductImage[] = $product_image_name;
            }

            $all_product_images = array_values(array_merge($product_images, $ProductImage));
        }

        $productImages = json_encode($all_product_images??$product_images);
        return $productImages;
    }


    public function saveSmallImage($image){
        $kb = 1024;
        $image_size = $image->getSize();

        // Shrink parameter logikasi
        if ($image_size > 700 * $kb) {
            $shrink_percent = 2;
        } elseif ($image_size > 600 * $kb && $image_size <= 700 * $kb) {
            $shrink_percent = 2;
        } elseif ($image_size > 400 * $kb && $image_size <= 500 * $kb) {
            $shrink_percent = 3;
        } elseif ($image_size > 300 * $kb && $image_size <= 400 * $kb) {
            $shrink_percent = 4;
        } elseif ($image_size > 200 * $kb && $image_size <= 300 * $kb) {
            $shrink_percent = 5;
        } elseif ($image_size > 100 * $kb && $image_size <= 200 * $kb) {
            $shrink_percent = 10;
        } elseif ($image_size <= 50 * $kb && $image_size > 40 * $kb) {
            $shrink_percent = 30;
        }elseif ($image_size <= 40 * $kb && $image_size > 30 * $kb) {
            $shrink_percent = 40;
        }elseif ($image_size <= 30 * $kb && $image_size > 20 * $kb) {
            $shrink_percent = 50;
        }elseif ($image_size <= 20 * $kb && $image_size > 10 * $kb) {
            $shrink_percent = 80;
        }elseif ($image_size <= 10 * $kb) {
            $shrink_percent = 100;
        }

        // Tasodifiy fayl nomini generatsiya qilish
        $random = $this->setRandom();
        $product_image_name = $random . '_' . date('Y-m-d_h-i-s') . '.' . $image->extension();

        // Tasvirni yaratish (Intervention Image orqali)
        $small_img = Image::make($image);

        // Zarur bo'lsa, shrinking (resizing) amalga oshiriladi
        if ($shrink_percent < 100) {
            // Sifatni kamaytirish
            $small_img->encode($image->extension(), $shrink_percent);  // Sifatni ..% ga kamaytirish
        }
        $small_img->resize(800, null, function ($constraint) {
            $constraint->aspectRatio(); // Aspekt nisbati saqlanadi
            $constraint->upsize(); // Rasmni kattalashmaslikka ruxsat berish
        });
        // Tasvirni belgilangan papkaga saqlash
        $path = storage_path("app/public/products/small");
        if (!file_exists($path)) {
            mkdir($path, 0755, true); // Agar papka mavjud bo'lmasa, yaratish
        }
        $small_img->save($path . '/' . $product_image_name);

        return $product_image_name;
    }


    public function setRandom(){
        $letters = range('a', 'z');
        $random_array = [$letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)], $letters[rand(0,25)]];
        $random = implode("", $random_array);
        return $random;
    }
}
