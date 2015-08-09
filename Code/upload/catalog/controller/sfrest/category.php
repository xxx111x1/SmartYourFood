<?php
/**
 * Created by PhpStorm.
 * User: Min
 * Date: 2015/8/2
 * Time: 21:50
 */
class ModelShopCategory extends Model{

    public function getCategories()
    {
        return array("不限","中餐","川菜","湘菜", "西餐","韩餐","日餐", "港式","台式","早茶","甜点","冰激凌", "奶茶","炸鸡","快餐","火锅");

    }
}