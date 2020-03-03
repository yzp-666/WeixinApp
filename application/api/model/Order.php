<?php


namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];
//    写入时间戳
    protected $autoWriteTimestamp = true;

//    自定义时间段写入
//    protected $createTime = '自定义字段名'
}