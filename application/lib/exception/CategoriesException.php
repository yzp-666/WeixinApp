<?php


namespace app\api\validate;


use app\lib\exception\BaseException;

class CategoriesException extends BaseException
{
    public $code = '404';
    public $msg = '指定的类目不存在，请检查ID';
    public $errorCode = 50000;
}