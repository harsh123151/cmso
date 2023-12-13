<?php
class Category{
    public static function getallcategory(){
        global $database;
        $result = $database->query("SELECT * FROM categories ORDER BY cat_title DESC");
        return $result;
    }

    public static function delete_cat($cat_id){
        global $database;
        $database->query("DELETE FROM categories WHERE cat_id=$cat_id");
    }
    public static function add_cat($cat_title){
        global $database;
        $result = $database->query("INSERT INTO categories(cat_title,cat_user_id) Values('$cat_title'," .Validation::getUserId() .")");
        return $result;
    }
    public static function fetch_specific_cat($cat_id){
        global $database;
        $result = $database->query("SELECT * FROM categories where cat_id=$cat_id");
        return $result;
    }
    public static function edit_cat($cat_title,$cat_id){
        global $database;
        $result = $database->query("UPDATE categories SET cat_title='$cat_title' where cat_id=$cat_id");
        return $result;
    }

}
?>