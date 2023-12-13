<?php
namespace MyApp\Helper;
class Helper{

    public static function get_base_dir(){
        return $_SERVER['DOCUMENT_ROOT'];
    }
    public static function move_file($tmp_location,$img_name){
        if(!move_uploaded_file($tmp_location,Helper::get_base_dir()."/cmso/images/$img_name")){
            echo " problem for uploading the image";
        }
    }

    public static function redirect($location){
        header("Location:" . $location);
        exit;
    }
}
?>