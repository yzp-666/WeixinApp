<?php


namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
class Category
{
    public function getAllCategories(){
        $categories = CategoryModel::all([],'img');
        if($categories->isEmpty()){
            throw new CategoriesException();
        }
        return $categories;
    }
}